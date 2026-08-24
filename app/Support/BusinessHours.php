<?php

namespace App\Support;

use Carbon\CarbonImmutable;

/**
 * Menghitung status buka/tutup Scolier dari jadwal di config/scolier.php.
 *
 * Seluruh perhitungan memakai zona waktu kantor (Asia/Jakarta), bukan zona
 * waktu server maupun pengunjung — jam operasional selalu berlaku waktu
 * setempat, dari mana pun halaman dibuka.
 */
class BusinessHours
{
    /** Nama hari mengikuti bahasa aktif, diindeks ISO-8601 (1 = Senin ... 7 = Minggu). */
    private static function label(int $isoDay): string
    {
        return __("site.hours.days.{$isoDay}");
    }

    /** Kunci jadwal di config, diindeks dengan ISO-8601. */
    private const KEYS = [
        1 => 'Mon',
        2 => 'Tue',
        3 => 'Wed',
        4 => 'Thu',
        5 => 'Fri',
        6 => 'Sat',
        7 => 'Sun',
    ];

    public function __construct(
        private readonly array $schedule,
        private readonly CarbonImmutable $now,
    ) {}

    public static function fromConfig(): self
    {
        $timezone = (string) config('scolier.contact.hours.timezone', 'Asia/Jakarta');

        return new self(
            (array) config('scolier.contact.hours.schedule', []),
            CarbonImmutable::now($timezone),
        );
    }

    /** Jadwal hari tertentu: ['09:00', '20:00'] atau null bila tutup. */
    public function rangeFor(int $isoDay): ?array
    {
        $range = $this->schedule[self::KEYS[$isoDay] ?? ''] ?? null;

        return is_array($range) && count($range) === 2 ? array_values($range) : null;
    }

    public function isOpen(): bool
    {
        $range = $this->rangeFor($this->now->dayOfWeekIso);

        if ($range === null) {
            return false;
        }

        [$open, $close] = $range;
        $current = $this->now->format('H:i');

        // Perbandingan string aman karena format selalu "HH:MM" dua digit.
        return $current >= $open && $current < $close;
    }

    /** Ada jadwal sama sekali? Dipakai untuk menyembunyikan kartu bila kosong. */
    public function hasSchedule(): bool
    {
        foreach (array_keys(self::KEYS) as $isoDay) {
            if ($this->rangeFor($isoDay) !== null) {
                return true;
            }
        }

        return false;
    }

    /** Label ringkas status, mengikuti bahasa aktif. */
    public function statusLabel(): string
    {
        return $this->isOpen() ? __('site.hours.open') : __('site.hours.closed');
    }

    /**
     * Keterangan pendamping status:
     * sedang buka  -> "Tutup pukul 20:00"
     * sedang tutup -> "Buka pukul 09:00" / "Buka Senin pukul 09:00"
     */
    public function statusDetail(): string
    {
        if ($this->isOpen()) {
            [, $close] = $this->rangeFor($this->now->dayOfWeekIso);

            return __('site.hours.closes_at', ['time' => $close]);
        }

        $next = $this->nextOpening();

        if ($next === null) {
            return __('site.hours.contact_us');
        }

        [$isoDay, $open] = $next;

        return $isoDay === $this->now->dayOfWeekIso
            ? __('site.hours.opens_at', ['time' => $open])
            : __('site.hours.opens_on', ['day' => self::label($isoDay), 'time' => $open]);
    }

    /**
     * Waktu buka berikutnya sebagai [isoDay, 'HH:MM'], atau null bila
     * tidak ada hari buka sama sekali.
     */
    private function nextOpening(): ?array
    {
        for ($offset = 0; $offset < 7; $offset++) {
            $day = $this->now->addDays($offset);
            $isoDay = $day->dayOfWeekIso;
            $range = $this->rangeFor($isoDay);

            if ($range === null) {
                continue;
            }

            [$open] = $range;

            // Hari ini hanya dihitung bila jam bukanya belum lewat.
            if ($offset === 0 && $this->now->format('H:i') >= $open) {
                continue;
            }

            return [$isoDay, $open];
        }

        return null;
    }

    /**
     * Seluruh minggu, urut Senin sampai Minggu, untuk ditampilkan sebagai daftar.
     *
     * @return array<int, array{label: string, range: ?string, closed: bool, isToday: bool}>
     */
    public function week(): array
    {
        $today = $this->now->dayOfWeekIso;

        return array_map(function (int $isoDay) use ($today) {
            $range = $this->rangeFor($isoDay);

            return [
                'label' => self::label($isoDay),
                'range' => $range ? "{$range[0]} - {$range[1]}" : null,
                'closed' => $range === null,
                'isToday' => $isoDay === $today,
            ];
        }, array_keys(self::KEYS));
    }

    /**
     * Format schema.org untuk JSON-LD, misalnya "Mo-Fr 09:00-20:00".
     *
     * @return array<int, string>
     */
    public function schemaSpecification(): array
    {
        $map = [1 => 'Mo', 2 => 'Tu', 3 => 'We', 4 => 'Th', 5 => 'Fr', 6 => 'Sa', 7 => 'Su'];
        $out = [];

        foreach ($map as $isoDay => $short) {
            if ($range = $this->rangeFor($isoDay)) {
                $out[] = "{$short} {$range[0]}-{$range[1]}";
            }
        }

        return $out;
    }
}

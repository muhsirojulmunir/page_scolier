---
name: framer-motion
description: Comprehensive guide, guidelines, patterns, and best practices for Motion (formerly Framer Motion) animation library by Motion Division (motion.dev) across React, Vue, and Vanilla JS.
---

# Framer Motion / Motion (motion.dev) Skill Guide

Motion (formerly Framer Motion) by Motion Division (`https://github.com/motiondivision/motion`) is a production-ready, high-performance animation engine for web applications (React, Vue, JS/TS).

---

## 1. Core Concepts & Installation

### Installation
```bash
npm install motion
```

### Imports
- **Vanilla JS / TS**: `import { animate, scroll, inView, timeline, spring } from "motion"`
- **React**: `import { motion, AnimatePresence, useScroll, useTransform, useSpring } from "motion/react"` (or `framer-motion`)
- **Vue**: `import { motion } from "motion-v"`

---

## 2. Core Animation API (React)

### Basic Motion Components
```tsx
import { motion } from "motion/react";

export function FadeInCard() {
  return (
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      animate={{ opacity: 1, y: 0 }}
      transition={{ duration: 0.5, ease: "easeOut" }}
      className="p-6 bg-white rounded-xl shadow-lg"
    >
      <h3>Animated Component</h3>
    </motion.div>
  );
}
```

### Hover, Tap & Focus Gestures
```tsx
<motion.button
  whileHover={{ scale: 1.05, filter: "brightness(1.1)" }}
  whileTap={{ scale: 0.95 }}
  transition={{ type: "spring", stiffness: 400, damping: 17 }}
  className="px-4 py-2 bg-blue-600 text-white rounded-lg"
>
  Click Me
</motion.button>
```

### Variants (Clean Animation State Management)
```tsx
const containerVariants = {
  hidden: { opacity: 0 },
  visible: {
    opacity: 1,
    transition: {
      staggerChildren: 0.1,
      delayChildren: 0.2,
    },
  },
};

const itemVariants = {
  hidden: { opacity: 0, y: 20 },
  visible: { opacity: 1, y: 0, transition: { duration: 0.4 } },
};

export function StaggeredList({ items }) {
  return (
    <motion.ul variants={containerVariants} initial="hidden" animate="visible">
      {items.map((item) => (
        <motion.li key={item.id} variants={itemVariants}>
          {item.name}
        </motion.li>
      ))}
    </motion.ul>
  );
}
```

---

## 3. Exit Animations with AnimatePresence

To animate elements as they unmount from the DOM:

```tsx
import { motion, AnimatePresence } from "motion/react";

export function Modal({ isOpen, onClose }) {
  return (
    <AnimatePresence>
      {isOpen && (
        <motion.div
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          exit={{ opacity: 0 }}
          className="fixed inset-0 bg-black/50 flex items-center justify-center"
        >
          <motion.div
            initial={{ scale: 0.9, opacity: 0, y: 20 }}
            animate={{ scale: 1, opacity: 1, y: 0 }}
            exit={{ scale: 0.95, opacity: 0, y: 10 }}
            transition={{ type: "spring", damping: 25, stiffness: 300 }}
            className="bg-white p-6 rounded-2xl max-w-md w-full"
          >
            <h2>Modal Title</h2>
            <button onClick={onClose}>Close</button>
          </motion.div>
        </motion.div>
      )}
    </AnimatePresence>
  );
}
```

---

## 4. Scroll Animations & Gestures

### Scroll-Triggered Fade In (While In View)
```tsx
<motion.section
  initial={{ opacity: 0, y: 50 }}
  whileInView={{ opacity: 1, y: 0 }}
  viewport={{ once: true, margin: "-100px" }}
  transition={{ duration: 0.6 }}
>
  <h2>Scroll Section</h2>
</motion.section>
```

### Scroll Progress Indicator (Hooks)
```tsx
import { motion, useScroll, useSpring } from "motion/react";

export function ScrollProgressBar() {
  const { scrollYProgress } = useScroll();
  const scaleX = useSpring(scrollYProgress, { stiffness: 100, damping: 30 });

  return (
    <motion.div
      style={{ scaleX }}
      className="fixed top-0 left-0 right-0 h-1 bg-blue-600 origin-left z-50"
    />
  );
}
```

---

## 5. Layout & Shared Element Transitions

Use `layout` prop for automatic smooth layout transitions, and `layoutId` for hero element morphing between pages or tabs.

```tsx
// Active tab indicator animation
{tabs.map((tab) => (
  <button key={tab.id} onClick={() => setActiveTab(tab.id)}>
    {tab.label}
    {activeTab === tab.id && (
      <motion.div
        layoutId="active-pill"
        className="absolute inset-0 bg-blue-500 rounded-full -z-10"
        transition={{ type: "spring", stiffness: 500, damping: 35 }}
      />
    )}
  </button>
))}
```

---

## 6. Vanilla JS / Imperative Motion API

Motion can also be used in pure Vanilla JS or Blade files without React:

```js
import { animate, scroll, inView } from "motion";

// 1. Basic Animate
animate(".card", { opacity: [0, 1], y: [20, 0] }, { duration: 0.5, easing: "ease-out" });

// 2. InView Trigger
inView(".animate-on-scroll", ({ target }) => {
  animate(target, { opacity: 1, transform: "none" }, { duration: 0.6 });
});

// 3. Scroll Driven
scroll(animate(".hero-bg", { opacity: [1, 0] }), {
  target: document.querySelector(".hero-container"),
});
```

---

## 7. Performance Best Practices

1. **Use GPU-Accelerated Properties**: Prefer animating `transform` (`x`, `y`, `scale`, `rotate`) and `opacity`. Avoid animating `width`, `height`, `top`, or `margin` directly unless using `layout` prop.
2. **Spring Physics Calibration**:
   - Dynamic UI (buttons, popovers): `stiffness: 400, damping: 25`
   - Smooth dialogs/drawers: `stiffness: 250, damping: 30`
   - Bouncy interactions: `stiffness: 300, damping: 15`
3. **Use `viewport={{ once: true }}`** for scroll animations so they don't trigger repeatedly when scrolling back up.

  /** @type {import('tailwindcss').Config} */
  module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "*.{js,ts,jsx,tsx,mdx}"
    ],
    theme: {
      extend: {
        fontFamily: {
          sans: ["Poppins", "sans-serif"],
        },
        colors: {
          // New warm amber palette
          "primary-amber": "#D97706", // utama
          "accent-amber": "#FBBF24", // aksen terang
          "light-amber": "#FEF3C7",  // latar belakang sangat terang
          "dark-amber": "#92400E",   // sidebar dan elemen gelap

          slate: {
            50: "#f8fafc",
            100: "#f1f5f9",
            200: "#e2e8f0",
            300: "#cbd5e1",
            400: "#94a3b8",
            500: "#64748b",
            600: "#475569",
            700: "#334155",
            800: "#1e293b",
            900: "#0f172a",
            950: "#020617",
          },
          gray: {
            100: "#f3f4f6",
            200: "#e5e7eb",
            300: "#d1d5db",
            400: "#9ca3af",
            500: "#6b7280",
            600: "#4b5563",
            700: "#374151",
            800: "#1f2937",
            900: "#111827",
          },

          border: "hsl(var(--border))",
          input: "hsl(var(--input))",
          ring: "hsl(var(--ring))",
          background: "hsl(var(--background))",
          foreground: "hsl(var(--foreground))",
          primary: {
            DEFAULT: "hsl(var(--primary))",
            foreground: "hsl(var(--primary-foreground))",
          },
          secondary: {
            DEFAULT: "hsl(var(--secondary))",
            foreground: "hsl(var(--secondary-foreground))",
          },
          muted: {
            DEFAULT: "hsl(var(--muted))",
            foreground: "hsl(var(--muted-foreground))",
          },
          accent: {
            DEFAULT: "hsl(var(--accent))",
            foreground: "hsl(var(--accent-foreground))",
          },
          destructive: {
            DEFAULT: "hsl(var(--destructive))",
            foreground: "hsl(var(--destructive-foreground))",
          },
          card: {
            DEFAULT: "hsl(var(--card))",
            foreground: "hsl(var(--card-foreground))",
          },
          popover: {
            DEFAULT: "hsl(var(--popover))",
            foreground: "hsl(var(--popover-foreground))",
          },
        },
        borderRadius: {
          lg: "var(--radius)",
          md: "calc(var(--radius) - 2px)",
          sm: "calc(var(--radius) - 4px)",
        },
        keyframes: {
          "fade-in": {
            "0%": { opacity: "0" },
            "100%": { opacity: "1" },
          },
          "slide-in-left": {
            "0%": { transform: "translateX(-100%)" },
            "100%": { transform: "translateX(0)" },
          },
          "slide-out-left": {
            "0%": { transform: "translateX(0)" },
            "100%": { transform: "translateX(-100%)" },
          },
        },
        animation: {
          "fade-in": "fade-in 0.5s ease-out",
          "slide-in-left": "slide-in-left 0.3s ease-out forwards",
          "slide-out-left": "slide-out-left 0.3s ease-out forwards",
        },
      },
    },
    plugins: [require("tailwindcss-animate")],
  }


import { useEffect, useState } from "react";
import { PullCord } from "pullcord";
import "pullcord/pullcord.css";

const STORAGE_KEY = "sakofah-theme";
const THEME_CHANGED_EVENT = "sakofah-theme-change";

type Theme = "light" | "dark";

function getPreferredTheme(): Theme {
    if (typeof window === "undefined") {
        return "light";
    }

    const storedTheme = window.localStorage.getItem(STORAGE_KEY);
    if (storedTheme === "light" || storedTheme === "dark") {
        return storedTheme;
    }

    return window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
}

function applyTheme(theme: Theme) {
    document.documentElement.classList.toggle("dark", theme === "dark");
    document.documentElement.dataset.theme = theme;
    document.documentElement.style.colorScheme = theme;

    document.querySelectorAll<HTMLElement>("[data-theme]").forEach((element) => {
        element.dataset.theme = theme;
    });
}

export function ThemePullCord() {
    const [theme, setTheme] = useState<Theme>(() => getPreferredTheme());

    useEffect(() => {
        applyTheme(theme);
        window.localStorage.setItem(STORAGE_KEY, theme);
        window.dispatchEvent(new CustomEvent(THEME_CHANGED_EVENT, { detail: { theme } }));
    }, [theme]);

    useEffect(() => {
        const mediaQuery = window.matchMedia("(prefers-color-scheme: dark)");

        const handleChange = (event: MediaQueryListEvent) => {
            const storedTheme = window.localStorage.getItem(STORAGE_KEY);
            if (storedTheme === "light" || storedTheme === "dark") {
                return;
            }

            setTheme(event.matches ? "dark" : "light");
        };

        mediaQuery.addEventListener("change", handleChange);

        return () => {
            mediaQuery.removeEventListener("change", handleChange);
        };
    }, []);

    const isLightOn = theme === "light";

    return (
        <PullCord
            ariaLabel={isLightOn ? "เปลี่ยนเป็นโทนมืด" : "เปลี่ยนเป็นโทนสว่าง"}
            pulled={isLightOn}
            onPull={() => setTheme((currentTheme) => (currentTheme === "dark" ? "light" : "dark"))}
            config={{
                gravity: 1320,
                damping: 0.935,
                iterations: 22,
                stretchMax: 34,
                stretchToggle: 18,
            }}
            className="theme-pullcord"
        />
    );
}

const formatter = new Intl.NumberFormat("en-US", {
    maximumFractionDigits: 2,
});

function parseNumber(value) {
    return Number(String(value).replace(/,/g, ""));
}

function countTo(element, target, duration = 1400) {
    const startTime = performance.now();
    const decimals = String(element.dataset.odometerValue || "").includes(".") ? 2 : 0;

    function tick(now) {
        const elapsed = Math.min((now - startTime) / duration, 1);
        const eased = 1 - Math.pow(1 - elapsed, 3);
        const current = target * eased;

        element.textContent = formatter.format(Number(current.toFixed(decimals)));

        if (elapsed < 1) {
            requestAnimationFrame(tick);
            return;
        }

        element.textContent = formatter.format(target);
    }

    requestAnimationFrame(tick);
}

function runOdometers(section) {
    section.querySelectorAll("[data-odometer-value]").forEach((element, index) => {
        const target = parseNumber(element.dataset.odometerValue);
        if (!Number.isFinite(target)) {
            return;
        }

        window.setTimeout(() => countTo(element, target), index * 80);
    });
}

document.querySelectorAll("[data-financial-odometer]").forEach((section) => {
    const odometers = section.querySelectorAll("[data-odometer-value]");

    odometers.forEach((element) => {
        element.textContent = "0";
    });

    const observer = new IntersectionObserver(
        (entries) => {
            const isVisible = entries.some((entry) => entry.isIntersecting);
            if (!isVisible) {
                return;
            }

            runOdometers(section);
            observer.disconnect();
        },
        {
            rootMargin: "0px 0px -18% 0px",
            threshold: 0.22,
        },
    );

    observer.observe(section);
});

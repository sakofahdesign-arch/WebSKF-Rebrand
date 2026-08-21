import React from "react";
import { createRoot } from "react-dom/client";
import { motion } from "framer-motion";
import { StackedLogos } from "../../components/ui/stacked-logos";

type ServiceItem = {
    id: string;
    title: string;
    href?: string;
    icon: React.ReactNode;
};

function Icon({ children }: { children: React.ReactNode }) {
    return (
        <svg
            className="h-5 w-5"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            strokeWidth="1.85"
            stroke="currentColor"
        >
            {children}
        </svg>
    );
}

function ServiceLogo({ service }: { service: ServiceItem }) {
    return (
        <a
            href={service.href}
            className="group inline-flex items-center justify-center gap-2 text-sm font-black text-emerald-950 transition duration-300 hover:text-emerald-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 focus-visible:ring-offset-2 focus-visible:ring-offset-white"
        >
            <span className="inline-flex h-5 w-5 shrink-0 items-center justify-center text-emerald-800 transition duration-300 group-hover:text-emerald-600">
                {service.icon}
            </span>
            <span className="whitespace-nowrap leading-none">{service.title}</span>
        </a>
    );
}

function ServicesPanel({ services }: { services: ServiceItem[] }) {
    const title = "บริการ";

    return (
        <div className="relative left-1/2 w-screen -translate-x-1/2 overflow-hidden bg-white py-16 text-emerald-950">
            <div className="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_50%_0%,rgba(16,185,129,0.10),transparent_28rem)]" />
            <div className="relative mx-auto w-full px-4">
                <motion.h2
                    className="mb-9 flex justify-center text-[clamp(2.2rem,5.5vw,4.5rem)] font-black leading-[0.82] text-emerald-950"
                    aria-label={title}
                    initial="hidden"
                    whileInView="visible"
                    viewport={{ once: false, amount: 0.75 }}
                    variants={{
                        hidden: {},
                        visible: {
                            transition: {
                                staggerChildren: 0.055,
                                delayChildren: 0.08,
                            },
                        },
                    }}
                >
                    {title.split("").map((char, index) => (
                        <motion.span
                            key={`${char}-${index}`}
                            className="inline-block"
                            aria-hidden="true"
                            variants={{
                                hidden: { y: 28, opacity: 0, filter: "blur(8px)" },
                                visible: {
                                    y: 0,
                                    opacity: 1,
                                    filter: "blur(0px)",
                                    transition: {
                                        type: "spring",
                                        bounce: 0.18,
                                        duration: 0.7,
                                    },
                                },
                            }}
                        >
                            {char}
                        </motion.span>
                    ))}
                </motion.h2>

                <StackedLogos
                    logoWidth="200px"
                    logoGroups={services.map((service) => [<ServiceLogo key={service.id} service={service} />])}
                    className="mx-auto"
                />
            </div>
        </div>
    );
}

document.querySelectorAll<HTMLElement>("[data-perspective-services]").forEach((mount) => {
    const services: ServiceItem[] = [
        {
            id: "register",
            title: "สมัครสมาชิก",
            href: mount.dataset.registerUrl,
            icon: (
                <Icon>
                    <path strokeLinecap="round" strokeLinejoin="round" d="M18 18.72a9.1 9.1 0 0 0 3.74-2.1 3 3 0 0 0-4.24-4.24m.5 6.34A9.07 9.07 0 0 1 12 21a9.07 9.07 0 0 1-6-2.28m12 0a5.97 5.97 0 0 0-12 0m6-7.47a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                </Icon>
            ),
        },
        {
            id: "deposit",
            title: "บริการเงินฝาก",
            href: mount.dataset.depositUrl,
            icon: (
                <Icon>
                    <path strokeLinecap="round" strokeLinejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9" />
                </Icon>
            ),
        },
        {
            id: "credit",
            title: "บริการสินเชื่อ",
            href: mount.dataset.creditUrl,
            icon: (
                <Icon>
                    <path strokeLinecap="round" strokeLinejoin="round" d="M2.25 18 9 11.25l4.3 4.31a12 12 0 0 1 5.82-5.52l2.74-1.22m0 0-3.75-2.25M21 18l-3.75-2.25m0 0L13.5 18" />
                </Icon>
            ),
        },
        {
            id: "document",
            title: "เอกสารสมาชิก",
            href: mount.dataset.documentUrl,
            icon: (
                <Icon>
                    <path strokeLinecap="round" strokeLinejoin="round" d="M19.5 14.25v-2.63a3.38 3.38 0 0 0-3.38-3.37h-1.5a1.13 1.13 0 0 1-1.12-1.13v-1.5a3.38 3.38 0 0 0-3.38-3.37H8.25M9 15l3 3m0 0 3-3m-3 3v-6M6 2.25h4.5L19.5 11.25v8.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25v-15A2.25 2.25 0 0 1 6 2.25Z" />
                </Icon>
            ),
        },
    ];

    createRoot(mount).render(
        <React.StrictMode>
            <ServicesPanel services={services} />
        </React.StrictMode>,
    );
});

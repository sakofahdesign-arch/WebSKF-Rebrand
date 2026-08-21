import React from "react";
import { createRoot } from "react-dom/client";
import { StaggeredGrid, type BentoItem } from "../../components/ui/staggered-grid";

function Icon({ children }: { children: React.ReactNode }) {
    return (
        <svg className="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            strokeWidth="1.8" stroke="currentColor">
            {children}
        </svg>
    );
}

document.querySelectorAll<HTMLElement>("[data-staggered-services]").forEach((mount) => {
    const images = JSON.parse(mount.dataset.images || "[]") as string[];
    const logoImage = mount.dataset.logoUrl;

    const items: BentoItem[] = [
        {
            id: "register",
            title: "สมัครสมาชิก",
            subtitle: "สมาชิก",
            description: "เริ่มต้นความมั่นคงทางการเงินกับเรา",
            href: mount.dataset.registerUrl,
            image: images[0],
            icon: (
                <Icon>
                    <path strokeLinecap="round" strokeLinejoin="round" d="M18 18.72a9.1 9.1 0 0 0 3.74-2.1 3 3 0 0 0-4.24-4.24m.5 6.34A9.07 9.07 0 0 1 12 21a9.07 9.07 0 0 1-6-2.28m12 0a5.97 5.97 0 0 0-12 0m6-7.47a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                </Icon>
            ),
        },
        {
            id: "deposit",
            title: "บริการเงินฝาก",
            subtitle: "เงินฝาก",
            description: "หลากหลายรูปแบบการออมที่ตอบโจทย์",
            href: mount.dataset.depositUrl,
            image: images[1],
            icon: (
                <Icon>
                    <path strokeLinecap="round" strokeLinejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9" />
                </Icon>
            ),
        },
        {
            id: "credit",
            title: "บริการสินเชื่อ",
            subtitle: "สินเชื่อ",
            description: "เสริมสภาพคล่องด้วยเงื่อนไขที่เป็นธรรม",
            href: mount.dataset.creditUrl,
            image: images[2],
            icon: (
                <Icon>
                    <path strokeLinecap="round" strokeLinejoin="round" d="M2.25 18 9 11.25l4.3 4.31a12 12 0 0 1 5.82-5.52l2.74-1.22m0 0-3.75-2.25M21 18l-3.75-2.25m0 0L13.5 18" />
                </Icon>
            ),
        },
        {
            id: "document",
            title: "เอกสารสมาชิก",
            subtitle: "เอกสาร",
            description: "ดาวน์โหลดแบบฟอร์มและเอกสารต่างๆ",
            href: mount.dataset.documentUrl,
            image: images[3],
            icon: (
                <Icon>
                    <path strokeLinecap="round" strokeLinejoin="round" d="M19.5 14.25v-2.63a3.38 3.38 0 0 0-3.38-3.37h-1.5a1.13 1.13 0 0 1-1.12-1.13v-1.5a3.38 3.38 0 0 0-3.38-3.37H8.25M9 15l3 3m0 0 3-3m-3 3v-6M6 2.25h4.5L19.5 11.25v8.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25v-15A2.25 2.25 0 0 1 6 2.25Z" />
                </Icon>
            ),
        },
    ];

    createRoot(mount).render(
        <React.StrictMode>
            <StaggeredGrid
                images={images}
                bentoItems={items}
                centerText="บริการ"
                logoImage={logoImage}
                showFooter={false}
                className="bg-transparent shadow-none"
            />
        </React.StrictMode>,
    );
});

import React from "react";
import { createRoot } from "react-dom/client";
import {
    MemberBenefitsReveal,
    type MemberBenefitItem,
} from "../../components/ui/member-benefits-reveal";

document.querySelectorAll<HTMLElement>("[data-member-benefits-reveal]").forEach((mount) => {
    let items: MemberBenefitItem[] = [];

    try {
        items = JSON.parse(mount.dataset.items || "[]") as MemberBenefitItem[];
    } catch (error) {
        console.error("Invalid member benefits data", error);
    }

    createRoot(mount).render(
        <React.StrictMode>
            <MemberBenefitsReveal
                title={mount.dataset.title || "สิทธิประโยชน์ เมื่อเป็นสมาชิกเรา"}
                subtitle={mount.dataset.subtitle || ""}
                items={items}
            />
        </React.StrictMode>,
    );
});

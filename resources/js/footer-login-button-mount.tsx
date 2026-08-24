import React from "react";
import { createRoot } from "react-dom/client";
import { LogIn } from "lucide-react";
import { CreepyButton } from "../../components/ui/creepy-button";

document.querySelectorAll<HTMLElement>("[data-footer-login-button]").forEach((mount) => {
    const href = mount.dataset.href || "/login";
    const label = mount.dataset.label || "เข้าสู่ระบบ";

    createRoot(mount).render(
        <React.StrictMode>
            <CreepyButton
                type="button"
                onClick={() => {
                    window.location.href = href;
                }}
                className="min-w-[8.4rem] bg-emerald-950/95 text-sm"
                coverClassName="gap-2 rounded-lg border border-white/80 bg-[#022c22] px-4 py-2.5 text-sm font-bold tracking-normal text-white shadow-[inset_0_0_0_1px_rgba(255,255,255,0.12)]"
            >
                <LogIn className="h-4 w-4" strokeWidth={2.6} />
                <span>{label}</span>
            </CreepyButton>
        </React.StrictMode>,
    );
});

<script setup lang="ts">
import { usePage, Link } from '@inertiajs/vue3';
import { LibraryBig, LayoutDashboard, ShieldCheck, BookOpen, Users, CreditCard } from 'lucide-vue-next';
import AppLogo from '@/components/AppLogo.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import type { NavItem } from '@/types';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user);

const mainNavItems = computed<NavItem[]>(() => {
    const items: NavItem[] = [
        {
            title: 'Tableau de bord',
            href: '/dashboard',
            icon: LayoutDashboard,
        },
        {
            title: 'Mes lectures',
            href: '/library',
            icon: LibraryBig,
        },
    ];

    if (user.value?.role === 'admin') {
        items.push(
            {
                title: 'Administration',
                href: '/admin',
                icon: ShieldCheck,
            },
            {
                title: 'Gestion Catalogue',
                href: '/admin/catalog',
                icon: BookOpen,
            },
            {
                title: 'Utilisateurs',
                href: '/admin/users',
                icon: Users,
            },
            {
                title: 'Plans & Abonnements',
                href: '/admin/plans',
                icon: CreditCard,
            }
        );
    }

    return items;
});

const footerNavItems: NavItem[] = [
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link href="/dashboard">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>

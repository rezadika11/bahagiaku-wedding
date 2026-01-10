<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { SidebarTrigger } from '@/components/ui/sidebar';
import type { BreadcrumbItemType } from '@/types';
import { router, usePage } from '@inertiajs/vue3';
import { LogOut, User } from 'lucide-vue-next';
import { computed } from 'vue';

const props = withDefaults(
    defineProps<{
        breadcrumbs?: BreadcrumbItemType[];
    }>(),
    {
        breadcrumbs: () => [],
    },
);

const page = usePage();
const user = computed(() => page.props.auth.user);

const initials = computed(() => {
    const name = user.value?.name || '';
    return name
        .split(' ')
        .map((n: string) => n[0])
        .join('')
        .toUpperCase()
        .substring(0, 2);
});

const handleLogout = () => {
    router.post('/logout');
};
</script>

<template>
    <header
        class="flex h-16 shrink-0 items-center gap-2 border-b border-sidebar-border/70 px-6 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12 md:px-4"
    >
        <div class="flex items-center gap-2">
            <SidebarTrigger class="-ml-1" />
            <template v-if="breadcrumbs && breadcrumbs.length > 0">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </template>
        </div>

        <div class="ml-auto flex items-center gap-2">
            <DropdownMenu>
                <DropdownMenuTrigger as-child>
                    <Button
                        variant="ghost"
                        class="relative h-8 w-auto justify-start gap-2 rounded-full px-2"
                    >
                        <Avatar class="h-8 w-8">
                            <AvatarImage
                                :src="user?.profile_photo_url"
                                :alt="user?.name"
                            />
                            <AvatarFallback>{{ initials }}</AvatarFallback>
                        </Avatar>
                        <span class="text-sm font-medium">{{
                            user?.name
                        }}</span>
                    </Button>
                </DropdownMenuTrigger>
                <DropdownMenuContent class="w-56" align="end">
                    <DropdownMenuLabel>
                        <div class="flex flex-col space-y-1">
                            <p class="text-sm leading-none font-medium">
                                {{ user?.name }}
                            </p>
                            <p
                                class="text-xs leading-none text-muted-foreground"
                            >
                                {{ user?.email }}
                            </p>
                        </div>
                    </DropdownMenuLabel>
                    <DropdownMenuSeparator />
                    <DropdownMenuItem>
                        <User class="mr-2 h-4 w-4" />
                        <span>Profile</span>
                    </DropdownMenuItem>
                    <DropdownMenuSeparator />
                    <DropdownMenuItem @click="handleLogout">
                        <LogOut class="mr-2 h-4 w-4" />
                        <span>Log out</span>
                    </DropdownMenuItem>
                </DropdownMenuContent>
            </DropdownMenu>
        </div>
    </header>
</template>

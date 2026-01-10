<script setup lang="ts">
import ConfirmDialog from '@/components/ConfirmDialog.vue';
import Pagination from '@/components/Pagination.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ExternalLink, Eye, Pencil, Trash2 } from 'lucide-vue-next';
import { ref, watch } from 'vue';

interface Props {
    invitations: {
        data: any[];
        links: any[];
        meta: any;
    };
    filters: {
        search?: string;
    };
}

const props = defineProps<Props>();
const search = ref(props.filters.search || '');

watch(search, (value) => {
    router.get(
        '/admin/invitations',
        { search: value },
        { preserveState: true, replace: true },
    );
});

const breadcrumbs = [
    {
        title: 'Invitations',
        href: '/admin/invitations',
    },
];

const getStatusVariant = (status: string) => {
    switch (status) {
        case 'published':
            return 'default';
        case 'draft':
            return 'secondary';
        case 'expired':
            return 'destructive';
        default:
            return 'outline';
    }
};

const showConfirmDialog = ref(false);
const invitationToDeleteId = ref<number | null>(null);

const confirmDelete = (id: number) => {
    invitationToDeleteId.value = id;
    showConfirmDialog.value = true;
};

const handleDelete = () => {
    if (invitationToDeleteId.value) {
        router.delete(`/admin/invitations/${invitationToDeleteId.value}`, {
            onFinish: () => {
                showConfirmDialog.value = false;
                invitationToDeleteId.value = null;
            },
        });
    }
};
</script>

<template>
    <Head title="Invitations" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-col gap-4 p-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">Invitations</h1>
                <Link href="/admin/invitations/create">
                    <Button>Create Invitation</Button>
                </Link>
            </div>

            <div class="flex items-center space-x-2">
                <Input
                    v-model="search"
                    placeholder="Search couples or slugs..."
                    class="max-w-sm"
                />
            </div>

            <!-- Table with horizontal scroll on mobile -->
            <div class="overflow-x-auto rounded-md border">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th class="p-4 font-medium">No</th>
                            <th class="p-4 font-medium whitespace-nowrap">
                                Slug
                            </th>
                            <th class="p-4 font-medium whitespace-nowrap">
                                Couple Name
                            </th>
                            <th class="p-4 font-medium whitespace-nowrap">
                                Client
                            </th>
                            <th class="p-4 font-medium whitespace-nowrap">
                                Theme
                            </th>
                            <th class="p-4 font-medium whitespace-nowrap">
                                Date
                            </th>
                            <th class="p-4 font-medium whitespace-nowrap">
                                Status
                            </th>
                            <th
                                class="p-4 text-right font-medium whitespace-nowrap"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(inv, index) in invitations.data"
                            :key="inv.id"
                            class="border-t hover:bg-gray-50 dark:hover:bg-gray-900"
                        >
                            <td class="p-4 text-gray-500">
                                {{
                                    invitations.meta?.from
                                        ? invitations.meta.from + index
                                        : index + 1
                                }}
                            </td>
                            <td class="p-4 font-mono text-xs whitespace-nowrap">
                                {{ inv.slug }}
                            </td>
                            <td class="p-4 font-medium whitespace-nowrap">
                                {{ inv.groom_name }} & {{ inv.bride_name }}
                            </td>
                            <td class="p-4 whitespace-nowrap text-gray-600">
                                {{ inv.client?.name }}
                            </td>
                            <td class="p-4 whitespace-nowrap text-gray-600">
                                {{ inv.theme?.name }}
                            </td>
                            <td class="p-4 whitespace-nowrap text-gray-500">
                                {{
                                    new Date(
                                        inv.wedding_date,
                                    ).toLocaleDateString()
                                }}
                            </td>
                            <td class="p-4">
                                <Badge :variant="getStatusVariant(inv.status)">
                                    {{ inv.status }}
                                </Badge>
                            </td>
                            <td
                                class="space-x-1 p-2 text-right whitespace-nowrap"
                            >
                                <Link :href="`/admin/invitations/${inv.id}`">
                                    <Button size="sm" variant="ghost">
                                        <Eye class="h-4 w-4" />
                                    </Button>
                                </Link>
                                <Link
                                    :href="`/admin/invitations/${inv.id}/edit`"
                                >
                                    <Button size="sm" variant="ghost">
                                        <Pencil class="h-4 w-4" />
                                    </Button>
                                </Link>
                                <a :href="`/u/${inv.slug}`" target="_blank">
                                    <Button size="sm" variant="ghost">
                                        <ExternalLink class="h-4 w-4" />
                                    </Button>
                                </a>
                                <Button
                                    size="sm"
                                    variant="ghost"
                                    class="text-red-500 hover:bg-red-50 hover:text-red-700"
                                    @click="confirmDelete(inv.id)"
                                >
                                    <Trash2 class="h-4 w-4" />
                                </Button>
                            </td>
                        </tr>
                        <tr v-if="invitations.data.length === 0">
                            <td
                                colspan="8"
                                class="p-8 text-center text-gray-500"
                            >
                                No invitations found.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <Pagination :links="invitations.links" />

            <!-- Confirm Dialog -->
            <ConfirmDialog
                :open="showConfirmDialog"
                title="Delete Invitation"
                message="Are you sure you want to delete this invitation? This action cannot be undone."
                @update:open="showConfirmDialog = $event"
                @confirm="handleDelete"
            />
        </div>
    </AppLayout>
</template>

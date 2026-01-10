<script setup lang="ts">
import ConfirmDialog from '@/components/ConfirmDialog.vue';
import Pagination from '@/components/Pagination.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { Eye, Pencil, Trash2 } from 'lucide-vue-next';
import { ref, watch } from 'vue';

interface Client {
    id: number;
    name: string;
    phone: string;
    email: string | null;
    created_at: string;
    invitations?: any[];
}

interface Props {
    clients: {
        data: Client[];
        links: any[];
        meta: any;
    };
    filters: {
        search?: string;
    };
}

const props = defineProps<Props>();
const search = ref(props.filters.search || '');
const isLoading = ref(false);

watch(search, (value) => {
    isLoading.value = true;
    router.get(
        '/admin/clients',
        { search: value },
        {
            preserveState: true,
            replace: true,
            onFinish: () => (isLoading.value = false),
        },
    );
});

const breadcrumbs = [
    {
        title: 'Clients',
        href: '/admin/clients',
    },
];

const showDeleteDialog = ref(false);
const clientToDelete = ref<Client | null>(null);

const confirmDelete = (client: Client) => {
    clientToDelete.value = client;
    showDeleteDialog.value = true;
};

const handleDelete = () => {
    if (clientToDelete.value) {
        router.delete(`/admin/clients/${clientToDelete.value.id}`);
        clientToDelete.value = null;
    }
};
</script>

<template>
    <Head title="Clients" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-col gap-4 p-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">Clients</h1>
                <Link href="/admin/clients/create">
                    <Button>Add Client</Button>
                </Link>
            </div>

            <div class="flex items-center space-x-2">
                <Input
                    v-model="search"
                    placeholder="Search clients..."
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
                                Name
                            </th>
                            <th class="p-4 font-medium whitespace-nowrap">
                                Contact
                            </th>
                            <th class="p-4 font-medium whitespace-nowrap">
                                Invitations
                            </th>
                            <th class="p-4 font-medium whitespace-nowrap">
                                Joined
                            </th>
                            <th
                                class="p-4 text-right font-medium whitespace-nowrap"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loading State -->
                        <tr v-if="isLoading">
                            <td
                                colspan="6"
                                class="p-8 text-center text-gray-500"
                            >
                                <div class="flex justify-center">
                                    <Loader2
                                        class="h-6 w-6 animate-spin text-primary"
                                    />
                                </div>
                            </td>
                        </tr>

                        <tr
                            v-else
                            v-for="(client, index) in clients.data"
                            :key="client.id"
                            class="border-t hover:bg-gray-50 dark:hover:bg-gray-900"
                        >
                            <td class="p-4 text-gray-500">
                                {{
                                    clients.meta?.from
                                        ? clients.meta.from + index
                                        : index + 1
                                }}
                            </td>
                            <td class="p-4 font-medium whitespace-nowrap">
                                {{ client.name }}
                            </td>
                            <td class="p-4">
                                <div class="whitespace-nowrap">
                                    {{ client.phone }}
                                </div>
                                <div
                                    class="max-w-[200px] truncate text-xs text-gray-500"
                                >
                                    {{ client.email }}
                                </div>
                            </td>
                            <td class="p-4">
                                <Badge variant="outline">
                                    {{ client.invitations?.length || 0 }}
                                    Invites
                                </Badge>
                            </td>
                            <td class="p-4 whitespace-nowrap text-gray-500">
                                {{
                                    new Date(
                                        client.created_at,
                                    ).toLocaleDateString()
                                }}
                            </td>
                            <td
                                class="space-x-1 p-2 text-right whitespace-nowrap"
                            >
                                <Link :href="`/admin/clients/${client.id}`">
                                    <Button size="sm" variant="ghost">
                                        <Eye class="h-4 w-4" />
                                    </Button>
                                </Link>
                                <Link
                                    :href="`/admin/clients/${client.id}/edit`"
                                >
                                    <Button size="sm" variant="ghost">
                                        <Pencil class="h-4 w-4" />
                                    </Button>
                                </Link>
                                <Button
                                    size="sm"
                                    variant="ghost"
                                    @click="confirmDelete(client)"
                                >
                                    <Trash2 class="h-4 w-4 text-red-500" />
                                </Button>
                            </td>
                        </tr>
                        <tr v-if="!isLoading && clients.data.length === 0">
                            <td
                                colspan="6"
                                class="p-8 text-center text-gray-500"
                            >
                                No clients found.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <Pagination :links="clients.links" />
        </div>
    </AppLayout>

    <!-- Confirm Delete Dialog -->
    <ConfirmDialog
        v-model:open="showDeleteDialog"
        title="Delete Client"
        :message="`Are you sure you want to delete ${clientToDelete?.name}? This action cannot be undone.`"
        confirm-text="Delete"
        cancel-text="Cancel"
        @confirm="handleDelete"
    />
</template>

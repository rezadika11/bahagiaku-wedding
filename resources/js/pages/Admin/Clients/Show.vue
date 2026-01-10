<script setup lang="ts">
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

interface Invitation {
    id: number;
    slug: string;
    groom_name: string;
    bride_name: string;
    wedding_date: string;
    status: string;
}

interface Client {
    id: number;
    name: string;
    phone: string;
    email: string | null;
    address: string | null;
    notes: string | null;
    created_at: string;
    invitations?: Invitation[];
}

const props = defineProps<{
    client: Client;
}>();

const breadcrumbs = [
    {
        title: 'Clients',
        href: '/admin/clients',
    },
    {
        title: props.client.name,
        href: '',
    },
];

const deleteClient = () => {
    if (
        confirm(
            'Are you sure you want to delete this client? All invitations will be deleted.',
        )
    ) {
        router.delete(`/admin/clients/${props.client.id}`);
    }
};
</script>

<template>
    <Head :title="client.name" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-col gap-6 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">{{ client.name }}</h1>
                    <p class="text-sm text-gray-500">
                        Member since
                        {{ new Date(client.created_at).toLocaleDateString() }}
                    </p>
                </div>
                <div class="space-x-2">
                    <Link
                        :href="`/admin/invitations/create?client_id=${client.id}`"
                    >
                        <Button>Create Invitation</Button>
                    </Link>
                    <Link :href="`/admin/clients/${client.id}/edit`">
                        <Button variant="outline">Edit</Button>
                    </Link>
                    <Button variant="destructive" @click="deleteClient"
                        >Delete</Button
                    >
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <!-- Client Details -->
                <Card>
                    <CardHeader>
                        <CardTitle>Contact Information</CardTitle>
                    </CardHeader>
                    <CardContent class="space-y-4">
                        <div>
                            <span class="block text-xs text-gray-500"
                                >Phone</span
                            >
                            <span class="font-medium">{{ client.phone }}</span>
                        </div>
                        <div v-if="client.email">
                            <span class="block text-xs text-gray-500"
                                >Email</span
                            >
                            <span class="font-medium">{{ client.email }}</span>
                        </div>
                        <div v-if="client.address">
                            <span class="block text-xs text-gray-500"
                                >Address</span
                            >
                            <span class="text-sm">{{ client.address }}</span>
                        </div>
                        <div v-if="client.notes">
                            <span class="block text-xs text-gray-500"
                                >Notes</span
                            >
                            <p
                                class="rounded bg-gray-50 p-2 text-sm text-gray-600"
                            >
                                {{ client.notes }}
                            </p>
                        </div>
                    </CardContent>
                </Card>

                <!-- Invitations List -->
                <Card class="md:col-span-2">
                    <CardHeader>
                        <CardTitle
                            >Invitations ({{
                                client.invitations?.length || 0
                            }})</CardTitle
                        >
                    </CardHeader>
                    <CardContent>
                        <table
                            class="w-full text-left text-sm"
                            v-if="
                                client.invitations &&
                                client.invitations.length > 0
                            "
                        >
                            <thead class="bg-gray-100 dark:bg-gray-800">
                                <tr>
                                    <th class="p-4 font-medium">Couple</th>
                                    <th class="p-4 font-medium">Date</th>
                                    <th class="p-4 font-medium">Slug</th>
                                    <th class="p-4 font-medium">Status</th>
                                    <th class="p-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="inv in client.invitations"
                                    :key="inv.id"
                                    class="border-t"
                                >
                                    <td class="p-4 font-medium">
                                        {{ inv.groom_name }} &
                                        {{ inv.bride_name }}
                                    </td>
                                    <td class="p-4">
                                        {{
                                            new Date(
                                                inv.wedding_date,
                                            ).toLocaleDateString()
                                        }}
                                    </td>
                                    <td class="p-4 font-mono text-xs">
                                        {{ inv.slug }}
                                    </td>
                                    <td class="p-4">
                                        <Badge
                                            :variant="
                                                inv.status === 'published'
                                                    ? 'default'
                                                    : 'secondary'
                                            "
                                        >
                                            {{ inv.status }}
                                        </Badge>
                                    </td>
                                    <td class="p-4 text-right">
                                        <Link
                                            :href="`/admin/invitations/${inv.id}`"
                                            class="text-blue-600 hover:underline"
                                        >
                                            Manage
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-else class="py-8 text-center text-gray-500">
                            No invitations created for this client yet.
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';

import { computed } from 'vue';
import AnagraficheController from '@/actions/App/Http/Controllers/AnagraficheController';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { TextArea } from '@/components/ui/text-area';
import anagrafiche from '@/routes/anagrafiche';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Modifica anagrafica',
                href: anagrafiche.index().url,
            },
        ],
    },
});

const props = defineProps({
    item: {
        type: Object,
        required: true,
    },
});

const user = computed(() => props.item.data);
</script>

<template>
    <Head title="Modifica anagrafica" />
    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        <h1 class="sr-only">Modifica anagrafica</h1>

        <Heading variant="small" title="Modifica anagrafica" />

        <Form
            class="space-y-6"
            v-bind="AnagraficheController.update.form(user.id)"
            v-slot="{ errors, processing }"
        >
            <div class="grid gap-2">
                <Label for="nome">Nome</Label>
                <Input
                    id="nome"
                    class="mt-1 block w-full"
                    name="nome"
                    :default-value="user.nome"
                    required
                    autocomplete="nome"
                    placeholder="Nome e Cognome"
                />
                <InputError class="mt-2" :message="errors.nome" />
            </div>
            <div class="grid gap-2">
                <Label for="email">E-mail</Label>
                <Input
                    id="email"
                    class="mt-1 block w-full"
                    name="email"
                    :default-value="user.email"
                    required
                    autocomplete="email"
                    placeholder="nome@email.com"
                />
                <InputError class="mt-2" :message="errors.email" />
            </div>
            <div class="grid gap-2">
                <Label for="telefono">Telefono</Label>
                <Input
                    id="telefono"
                    class="mt-1 block w-full"
                    name="telefono"
                    :default-value="user.telefono"
                    required
                    autocomplete="telefono"
                />
                <InputError class="mt-2" :message="errors.telefono" />
            </div>
            <div class="grid gap-2">
                <Label for="cellulare">Cellulare</Label>
                <Input
                    id="cellulare"
                    class="mt-1 block w-full"
                    name="cellulare"
                    :default-value="user.cellulare"
                    required
                    autocomplete="cellulare"
                />
                <InputError class="mt-2" :message="errors.cellulare" />
            </div>
            <div class="grid gap-2">
                <Label for="cellulare">Note</Label>
                <TextArea
                    id="note"
                    class="mt-1 block w-full"
                    name="note"
                    :default-value="user.note"
                    autocomplete="note"
                />
                <InputError class="mt-2" :message="errors.note" />
            </div>

            <div class="flex items-center gap-4">
                <Button :disabled="processing" data-test="update-profile-button"
                    >Save</Button
                >
            </div>
        </Form>

        {{ item.data }}
    </div>
</template>

<style scoped></style>

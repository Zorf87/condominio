<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { Edit, EllipsisVertical, Trash } from '@lucide/vue';
import { DropdownMenuItemIndicator, DropdownMenuPortal } from 'reka-ui';
import Button from '@/components/ui/button/Button.vue';
import DropdownMenu from '@/components/ui/dropdown-menu/DropdownMenu.vue';
import DropdownMenuCheckboxItem from '@/components/ui/dropdown-menu/DropdownMenuCheckboxItem.vue';
import DropdownMenuContent from '@/components/ui/dropdown-menu/DropdownMenuContent.vue';
import DropdownMenuGroup from '@/components/ui/dropdown-menu/DropdownMenuGroup.vue';
import DropdownMenuItem from '@/components/ui/dropdown-menu/DropdownMenuItem.vue';
import DropdownMenuTrigger from '@/components/ui/dropdown-menu/DropdownMenuTrigger.vue';
import { useConfirm } from '@/composables/useConfirm';
import anagrafiche from '@/routes/anagrafiche';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Anagrafiche',
                href: anagrafiche.index().url,
            },
        ],
    },
});

defineProps({
    items: {
        type: Object,
        required: true,
    },
});

const { open } = useConfirm();

async function handleDelete(user: any) {
    const { isCanceled } = await open({
        title: "Eliminare l'anagrafica?",
        description: "L'operazione è irreversibile.",
        confirmText: 'Elimina',
        variant: 'destructive',
    });

    console.log(user, 'isCanceled', isCanceled);

    if (isCanceled) {
        return;
    }

    router.delete(anagrafiche.destroy(user));
}
</script>
<template>
    <Head title="Anagrafiche" />
    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        <section class="mx-auto w-full max-w-3/4">
            <ul role="list" class="divide-y divide-white/5">
                <li
                    v-for="item in items.data"
                    :key="item.id"
                    class="flex justify-between gap-x-6 py-5"
                >
                    <div class="flex min-w-0 gap-x-4">
                        <!-- <img
                            class="size-12 flex-none rounded-full bg-gray-800 outline -outline-offset-1 outline-white/10"
                            :src="person.imageUrl"
                            alt=""
                        /> -->
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm/6 font-semibold text-white">
                                {{ item.nome }}
                            </p>
                            <p class="mt-1 truncate text-xs/5 text-gray-400">
                                {{ item.email }} - {{ item.telefono }} -
                                {{ item.cellulare }}
                            </p>
                        </div>
                    </div>
                    <div
                        class="hidden shrink-0 sm:flex sm:flex-col sm:items-end"
                    >
                        <DropdownMenu>
                            <DropdownMenuTrigger>
                                <Button variant="ghost" class="cursor-pointer"
                                    ><EllipsisVertical
                                /></Button>
                            </DropdownMenuTrigger>

                            <DropdownMenuPortal>
                                <DropdownMenuContent>
                                    <DropdownMenuItem>
                                        <Link
                                            :href="
                                                anagrafiche.edit(item.id).url
                                            "
                                        >
                                            <Button variant="link"
                                                ><Edit /> Modifica</Button
                                            >
                                        </Link>
                                    </DropdownMenuItem>
                                    <DropdownMenuItem>
                                        <Button
                                            variant="link"
                                            class="text-red-400"
                                            @click="handleDelete(item)"
                                            ><Trash /> Elimina</Button
                                        ></DropdownMenuItem
                                    >

                                    <DropdownMenuGroup>
                                        <DropdownMenuItem />
                                    </DropdownMenuGroup>

                                    <DropdownMenuCheckboxItem>
                                        <DropdownMenuItemIndicator />
                                    </DropdownMenuCheckboxItem>

                                    <!-- <DropdownMenuRadioGroup>
                                        <DropdownMenuRadioItem>
                                            <DropdownMenuItemIndicator />
                                        </DropdownMenuRadioItem>
                                    </DropdownMenuRadioGroup> -->

                                    <!-- <DropdownMenuSub>
                                        <DropdownMenuSubTrigger />
                                        <DropdownMenuPortal>
                                            <DropdownMenuSubContent />
                                        </DropdownMenuPortal>
                                    </DropdownMenuSub>

                                    <DropdownMenuSeparator />
                                    <DropdownMenuArrow /> -->
                                </DropdownMenuContent>
                            </DropdownMenuPortal>
                        </DropdownMenu>
                        <!-- <p class="text-sm/6 text-white">{{ person.role }}</p> -->
                        <!-- <p
                            v-if="item.updated_at"
                            class="mt-1 text-xs/5 text-gray-400"
                        >
                            Last seen
                            <time :datetime="item.updated_at">{{
                                item.updated_at
                            }}</time>
                        </p>
                        <div v-else class="mt-1 flex items-center gap-x-1.5">
                            <div
                                class="flex-none rounded-full bg-emerald-500/30 p-1"
                            >
                                <div
                                    class="size-1.5 rounded-full bg-emerald-500"
                                ></div>
                            </div>
                            <p class="text-xs/5 text-gray-400">Online</p>
                        </div> -->
                    </div>
                </li>
            </ul>
        </section>
    </div>
</template>

<style scoped></style>

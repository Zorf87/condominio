<script setup lang="ts" generic="TData extends RowData">
import {
    ArrowDownWideNarrow,
    ArrowUpDown,
    ArrowUpWideNarrow,
    ChevronLeft,
    ChevronRight,
    ChevronsLeft,
    ChevronsRight,
} from '@lucide/vue';
import type { ColumnDef, RowData } from '@tanstack/vue-table';
import { FlexRender, useTable } from '@tanstack/vue-table';

import { useTanStackTableDevtools } from '@tanstack/vue-table-devtools';
import { ref } from 'vue';
import Button from '@/components/ui/button/Button.vue';
import Select from '@/components/ui/select/Select.vue';
import SelectContent from '@/components/ui/select/SelectContent.vue';
import SelectItem from '@/components/ui/select/SelectItem.vue';
import SelectTrigger from '@/components/ui/select/SelectTrigger.vue';
import SelectValue from '@/components/ui/select/SelectValue.vue';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import { features } from './features';
import type { DataTableFeatures } from './features';

const props = defineProps<{
    columns: ColumnDef<DataTableFeatures, TData>[];
    data: TData[];
}>();
const pagination = ref({
    pageIndex: 0,
    pageSize: 50, // default a 50
});

const table = useTable({
    key: 'letture-data-table',
    features,
    get data() {
        return props.data;
    },
    get columns() {
        return props.columns;
    },
    state: {
        get pagination() {
            return pagination.value;
        },
    },
    onPaginationChange: (updaterOrValue) => {
        pagination.value =
            typeof updaterOrValue === 'function'
                ? updaterOrValue(pagination.value)
                : updaterOrValue;
    },
});

useTanStackTableDevtools(table);
</script>

<template>
    <div
        class="relative flex flex-1 flex-col gap-4 overflow-auto px-4 outline-none lg:px-6"
    >
        <div v-if="$slots.toolbar" class="flex items-center gap-2">
            <slot name="toolbar" :table="table" />
        </div>
        <div class="overflow-hidden rounded-lg border">
            <Table class="table-fixed">
                <colgroup>
                    <col
                        v-for="header in table.getFlatHeaders()"
                        :key="header.id"
                        :style="{ width: `${header.getSize()}px` }"
                    />
                </colgroup>
                <TableHeader class="sticky top-0 z-10 bg-muted">
                    <TableRow
                        v-for="headerGroup in table.getHeaderGroups()"
                        :key="headerGroup.id"
                    >
                        <TableHead
                            v-for="header in headerGroup.headers"
                            :key="header.id"
                            :style="{
                                cursor: header.column.getCanSort()
                                    ? 'pointer'
                                    : undefined,
                            }"
                            @click="
                                header.column.getToggleSortingHandler()?.(
                                    $event,
                                )
                            "
                            ><template v-if="!header.isPlaceholder">
                                <FlexRender :header="header" />
                                <component
                                    :is="
                                        {
                                            asc: ArrowUpWideNarrow,
                                            desc: ArrowDownWideNarrow,
                                        }[
                                            header.column.getIsSorted() as string
                                        ] || ArrowUpDown
                                    "
                                    class="ml-1 inline h-4 w-4"
                                />
                            </template>
                        </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <template v-if="table.getRowModel().rows?.length">
                        <TableRow
                            v-for="row in table.getRowModel().rows"
                            :key="row.id"
                            :data-state="row.getIsSelected() && 'selected'"
                        >
                            <TableCell
                                v-for="cell in row.getVisibleCells()"
                                :key="cell.id"
                            >
                                <FlexRender :cell="cell" />
                            </TableCell>
                        </TableRow>
                    </template>
                    <template v-else>
                        <TableRow>
                            <TableCell
                                :colspan="columns.length"
                                class="h-24 text-center"
                            >
                                No results.
                            </TableCell>
                        </TableRow>
                    </template>
                </TableBody>
            </Table>
        </div>
        <!-- Barra di Paginazione shadcn-vue -->
        <div class="flex items-center justify-between px-2">
            <!-- Info righe selezionate o conteggio totale -->
            <div class="flex-1 text-sm text-muted-foreground">
                <!-- <template v-if="table.getFilteredSelectedRowModel">
                {{ table.getFilteredSelectedRowModel().rows.length }} di
                {{ table.getFilteredRowModel().rows.length }} riga/he
                selezionate.
            </template>
            <template v-else>
                Totale {{ table.getFilteredRowModel().rows.length }} elementi.
            </template> -->
            </div>

            <div class="flex items-center space-x-6 lg:space-x-8">
                <!-- Selettore Righe per Pagina -->
                <div class="flex items-center space-x-2">
                    <p class="text-sm font-medium">Righe per pagina</p>
                    <Select
                        :model-value="`${table.atoms.pagination.get().pageSize}`"
                        @update:model-value="
                            (val) => table.setPageSize(Number(val))
                        "
                    >
                        <SelectTrigger class="h-8 w-17.5">
                            <SelectValue
                                :placeholder="`${table.atoms.pagination.get().pageSize}`"
                            />
                        </SelectTrigger>
                        <SelectContent side="top">
                            <SelectItem
                                v-for="pageSize in [10, 20, 30, 50, 100]"
                                :key="pageSize"
                                :value="`${pageSize}`"
                            >
                                {{ pageSize }}
                            </SelectItem>
                        </SelectContent>
                    </Select>
                </div>

                <!-- Indicatore di Pagina -->
                <div
                    class="flex w-25 items-center justify-center text-sm font-medium"
                >
                    Pagina {{ table.atoms.pagination.get().pageIndex + 1 }} di
                    {{ table.getPageCount() }}
                </div>

                <!-- Pulsanti di Navigazione -->
                <div class="flex items-center space-x-2">
                    <Button
                        variant="outline"
                        class="hidden h-8 w-8 p-0 lg:flex"
                        :disabled="!table.getCanPreviousPage()"
                        @click="table.firstPage()"
                    >
                        <span class="sr-only">Vai alla prima pagina</span>
                        <ChevronsLeft class="h-4 w-4" />
                    </Button>
                    <Button
                        variant="outline"
                        class="h-8 w-8 p-0"
                        :disabled="!table.getCanPreviousPage()"
                        @click="table.previousPage()"
                    >
                        <span class="sr-only">Pagina precedente</span>
                        <ChevronLeft class="h-4 w-4" />
                    </Button>
                    <Button
                        variant="outline"
                        class="h-8 w-8 p-0"
                        :disabled="!table.getCanNextPage()"
                        @click="table.nextPage()"
                    >
                        <span class="sr-only">Pagina successiva</span>
                        <ChevronRight class="h-4 w-4" />
                    </Button>
                    <Button
                        variant="outline"
                        class="hidden h-8 w-8 p-0 lg:flex"
                        :disabled="!table.getCanNextPage()"
                        @click="table.lastPage()"
                    >
                        <span class="sr-only">Vai all'ultima pagina</span>
                        <ChevronsRight class="h-4 w-4" />
                    </Button>
                </div>
            </div>
        </div>
    </div>
</template>

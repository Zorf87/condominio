<script setup lang="ts" generic="TData extends RowData">
import type { RowData } from '@tanstack/vue-table';
import Input from '@/components/ui/input/Input.vue';
import type { AppTable } from './table-types';

defineProps<{
    table: AppTable<TData>;
    columnId: string;
    placeholder?: string;
}>();
</script>

<template>
    <Input
        class="max-w-sm"
        :placeholder="placeholder"
        :model-value="table.getColumn(columnId)?.getFilterValue() as string"
        @update:model-value="table.getColumn(columnId)?.setFilterValue($event)"
    />
</template>

// components/data-table/table-types.ts
import type { RowData, Table } from '@tanstack/vue-table';
import type { features } from './features';

export type AppTable<TData extends RowData> = Table<typeof features, TData>;

<script setup lang="ts">
import { computed, type HTMLAttributes } from 'vue'
import TableRow from './TableRow.vue'
import TableCell from './TableCell.vue'
import { cn } from '@/lib/utils'

interface Props {
  class?: HTMLAttributes['class']
  colspan?: number
}

const props = withDefaults(defineProps<Props>(), {
  colspan: 1,
})
</script>

<template>
  <TableRow>
    <TableCell
      :class="
        cn(
          'p-24 text-center align-middle text-sm text-muted-foreground',
          props.class,
        )
      "
      :colspan="colspan"
    >
      <slot />
    </TableCell>
  </TableRow>
</template>

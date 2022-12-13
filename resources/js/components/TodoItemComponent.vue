<template>
    <li :class="{'list-group-item border-0 d-flex align-items-center ps-0': true, 'text-decoration-line-through': todo.is_completed}">
        <input :id="todo.id"
               v-model="todo.is_completed"
               class="form-check-input me-3" type="checkbox" value="" aria-label="..."/>
        <label :for="todo.id">{{ todo.text }}</label>

        <span @click="this.delete(todo.id)"
            class="btn btn-outline-warning btn-block shadow-none btn-sm mx-2">&times;</span>
    </li>
</template>

<script>
export default {
    props: {
        todo: Object,
        update: Function,
        delete: Function
    },
    watch: {
        'todo.is_completed'(newValue) {
            this.update(this.todo);
        }
    }
}
</script>

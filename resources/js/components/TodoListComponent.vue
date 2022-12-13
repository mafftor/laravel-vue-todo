<template>
    <ul class="list-group rounded-0" v-for="task in todo">
        <todo-item-component
            :todo="task"
            :update="this.update"
            :delete="this.delete"
        ></todo-item-component>
    </ul>
</template>

<script>
import TodoItemComponent from "./TodoItemComponent.vue";

export default {
    components: {TodoItemComponent},
    props: {
        todo: Array,
        update: Function,
        delete: Function
    }
}
</script>

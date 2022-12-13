<template>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-8 col-xl-6">
                <div class="card rounded-3">
                    <div class="card-body p-4">
                        <p class="mb-2"><span class="h2 me-2">TODO:</span> <span
                            class="badge bg-danger">checklist</span></p>

                        <todo-list-component
                            :todo="todo"
                            :update="update"
                            :delete="delete"
                        ></todo-list-component>

                        <div class="form-outline mt-4">
                            <label class="form-label text-danger" for="form1">Enter your task here</label>
                            <input v-on:keyup.enter="create"
                                   v-on:keydown="errors = []"
                                   v-model="text"
                                   type="text" id="form1" class="form-control" />
                        </div>

                        <div v-if="errors.length" v-for="error in errors" class="alert alert-danger mt-3 mb-0" role="alert">
                            {{ error }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TodoListComponent from "./TodoListComponent.vue";

export default {
    components: {TodoListComponent},
    data() {
        return {
            todo: [],
            text: '',
            errors: [],
        }
    },
    methods: {
        get() {
            axios.get('todo')
                .then(response => {
                    this.todo = response.data;
                });
        },
        create() {
            axios.post('/todo', {
                text: this.text,
            })
                .then(response => {
                    this.reset();
                    this.get();
                })
                .catch(error => {
                    this.errors = [];
                    if (error.response.data.message) {
                        this.errors.push(error.response.data.message);
                    }
                });
        },
        update(todo) {
            axios.put('/todo/' + todo.id, {
                is_completed: todo.is_completed,
            })
                .then(response => {
                    this.get();
                });
        },
        delete(id) {
            axios.delete('/todo/' + id)
                .then(response => {
                    this.reset();
                    this.get();
                });
        },
        reset() {
            this.text = '';
        }
    },
    mounted() {
        this.get();
    }
}
</script>

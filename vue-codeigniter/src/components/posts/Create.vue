<template>
    <div class="posts">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div v-if="errors.length">
                        <div v-for="error in errors" :key="error.index" class="alert alert-danger mt-1" role="alert">
                            {{ error }}
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            TAMBAH POST
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="PostStore">

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="post.name"
                                        placeholder="Masukkan Nama">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" v-model="post.email"
                                        placeholder="Masukkan Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" v-model="post.password"
                                        placeholder="Masukkan Password">
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <input type="text" class="form-control" v-model="post.gender"
                                        placeholder="Masukkan Gender">
                                </div>
                                <div class="form-group">
                                    <label>Married</label>
                                    <input type="text" class="form-control" v-model="post.is_married"
                                        placeholder="Masukkan Status">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" v-model="post.address" rows="5"
                                        placeholder="Masukkan Alamat"></textarea>
                                </div>
                                <button type="submit" class="btn btn-md btn-success mr-2">SIMPAN</button>
                                <button type="reset" class="btn btn-md btn-danger">RESET</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                post: {},
                errors: []
            }
        },
        methods: {
            PostStore(e) {

                if (this.post.name && this.post.email && this.post.password && this.post.gender  && this.post.is_married && this.post.address) {

                    axios.post('http://localhost/restCI-master/index.php/Cust/add', this.post)
                        .then(() => {
                            this.$router.push({
                                name: 'posts'
                            });
                        }).catch(error => {
                            console.log(error.response);
                        });

                }

                this.errors = [];

                if (!this.post.name) {
                    this.errors.push('Masukkan Nama.');
                }

                if (!this.post.email) {
                    this.errors.push('Masukkan Email.');
                }

                if (!this.post.password) {
                    this.errors.push('Masukkan Password.');
                }

                if (!this.post.gender) {
                    this.errors.push('Masukkan Gender.');
                }

                if (!this.post.is_married) {
                    this.errors.push('Masukkan Status.');
                }

                if (!this.post.address) {
                    this.errors.push('Masukkan Alamat.');
                }
                

                e.preventDefault();

            }
        }
    }
</script>
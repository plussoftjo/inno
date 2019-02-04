<template>
	<div class="newUser">
		<div class="card">
			<div class="card-header">
				<div class="title">
					New User
				</div>
			</div>
			<div class="card-body">
				<div class="alert alert-danger" v-if="errors.length != 0">
					<span v-for="err in errors" :key="err">{{err[0]}} <br></span>
				</div>
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" id="name" v-model="user.name" class="form-control">
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" id="email" v-model="user.email" class="form-control">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" id="password" v-model="user.password" class="form-control">
				</div>
				<div class="row">
					<div class="col-md-6">
						<button class="btn btn-success" @click="store">Store</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				user:{name:'',password:'',email:''},
				errors:[]
			}
		},
		methods:{
			store() {
				const vm = this;
				axios.post('api/users/store',vm.user).then(response => {
					vm.$router.push({name:'users'});
				}).catch(err => {
					vm.errors = err.response.data.error;
				});
			}
		}
	}
</script>
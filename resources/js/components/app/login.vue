<template>
	<div class="login">
		<div class="card">
			<div class="card-header">
				<div class="title">Login</div>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" id="email" v-model="user.email" class="form-control">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" id="password"  v-model="user.password" class="form-control">
				</div>
				<div class="btn btn-success" @click="login">
					Login
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				user:{email:'',password:''}
			}
		},
		methods:{
			login()
			{
				const vm =this;
				axios.post('/api/users/login',vm.user).then(response => {

				}).catch(err => {
					console.log(err)
				});
			}
		}
	}
</script>
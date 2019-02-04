<template>
	<div class="users">
		<div class="card">
			<div class="card-header">
				<div class="title">
					Users
				</div>
			</div>
			<div class="card-body">
	
		<div class="btn btn-info" @click="$router.push({name:'newUser'})">New User</div>
	
		<table class="table table-bordered">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">ID</th>
		      <th scope="col">Name</th>
		      <th scope="col">Email</th>
		      <th scope="col">Count</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr v-for="(user,index) in users" >
		      <th scope="row">{{user.id}}</th>
		      <td>{{user.name}}</td>
		      <td>{{user.email}}</td>
		      <td>{{user.count}}</td>
		    </tr>
		  </tbody>
		</table>
		<!-- END USER TAPLE -->
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				users:[]
			}
		},
		methods:{
			install() {
				const vm = this;
				axios.get('api/users/index').then(response => {
					vm.users = response.data
				}).catch(err => {
					console.log(err)
				});
			}
		},
		created() {
			const vm = this;
			vm.install();
		}
	}
</script>
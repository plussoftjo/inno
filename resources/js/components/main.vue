<template>
    <div class="app">
    	<div class="row">
    		<div class="col-md-3">
    			<ul class="list-group">
				  <li class="list-group-item active">ADMIN PANEL</li>
				  <li class="list-group-item" @click="$router.push({name:'dashboard'})">DASHBOARD</li>
				  <li class="list-group-item" @click="$router.push({name:'Submit'})">Submit Active ingredient</li>
				  <li class="list-group-item" @click="$router.push({name:'New'})">New Entry\Barcode</li>
				  <li class="list-group-item" @click="$router.push({name:'table'})">View Table</li>
				  <li class="list-group-item" @click="$router.push({name:'users'})" v-if="user.type == 1">Users</li>
				<a href="/logout">  <li class="list-group-item">logout</li></a>
				</ul>
    		</div>
    		<div class="col-md-9">
					<div class="card">
						<div class="card-header">
							<div class="ctitle">
								{{$route.name}}
							</div>
						</div>
						<div class="card-body">
						 <router-view></router-view>
						</div>
					</div>
    		</div>
    	</div>
       
    </div>
</template>

<script>
    export default {
        mounted() {
        	const vm = this;
        	axios.get('/users/getAuth').then(response => {
        		vm.user = response.data;
        	}).catch(err => {
        		console.log(err)
        	});
        },
        data() {
        	return {
        		user:{}
        	}
        }
    }
</script>
<style>
	.ctitle{font-size: 20px; font-weight: 900; }
	.list-group-item{cursor: pointer; transition: all 0.3s;}
	.list-group-item:hover { background-color: rgba(0,0,0,0.09); color: white;}
</style>
<template>
	<div class="submit">
		<div class="card bg-primary text-white">
			<div class="card-title">
				<div class="title">
					Register New Card
				</div>
			</div>
			<div class="card-body">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="Active ingredient">Active ingredient </label>
								<input type="text" class="form-control" id="Active ingredient" v-model="active.active">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="counseling">counseling</label>
								<input type="text" class="form-control" id="counseling" v-model="active.cons">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="Warnings">Warnings</label>
								<input type="text" class="form-control" id="Warnings" v-model="active.warn">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="Contraindications">Contraindications</label>
								<input type="text" class="form-control" id="Contraindications" v-model="active.cont">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<button type="button" class="btn btn-success btn-block" @click="store">Submit</button>
						</div>
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
				active:{active:'',cons:'',warn:'',cont:''}
			}
		},
		methods:{
			store() {
				const vm = this;
				axios.post('/api/active/store',vm.active).then(response => {
					location.reload();
				}).catch(err => {
					console.log(err);
				});
			}
		}
	}
</script>
<style>
	.title{padding: 5px; text-align: center; font-size: 20px; font-weight: 700;}
</style>
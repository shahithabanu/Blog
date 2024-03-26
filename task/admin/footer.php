</main>


			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted" target="_blank"><strong>Bootstrap Admin Template</strong></a>								&copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
	<script>
    $(document).ready(function() {
        $("#your_summernote").summernote({
			height:250
		});
        $('.dropdown-toggle').dropdown();
    });
</script>
	<script src="<?php echo $admin_url ?>assests/js/app.js"></script>



</body>

</html>
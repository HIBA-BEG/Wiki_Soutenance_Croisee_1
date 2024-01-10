<?php require APPROOT . '/views/inc/header.php'; ?>

<!-- component -->
<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
	<div class="relative py-3 sm:max-w-xl sm:mx-auto">
		<div
			class="absolute inset-0 bg-gradient-to-r from-pink-400 to-pink-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
		</div>
		<div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
			<div class="max-w-md mx-auto">
				<div>
					<h1 class="text-2xl font-semibold">Hello Again! Welcome Back</h1>
				</div>
				<form action="<?php echo URLROOT; ?>/users/login" method="post">
					<div class="divide-y divide-gray-200">
						<div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
							<div class="relative">
								<input placeholder="Email Address"  id="Email" name="Email" type="text"
									class="h-10 w-full border-b-2 border-gray-300 text-pink-600 focus:outline-none <?php echo (!empty($data['email_err'])) ? 'border-red-500 text-red-500' : 'border-none'; ?>" />
								
								<span class="text-red-500">
									<?php echo $data['email_err']; ?>
								</span>
							</div>
							<div class="relative">
								<input placeholder="Password"  id="PasswordHash" name="PasswordHash" type="password"
									class="h-10 w-full border-b-2 border-gray-300 text-pink-600 focus:outline-none <?php echo (!empty($data['password_err'])) ? 'border-red-500 text-red-500' : 'border-none'; ?>"/>
								<span class="text-red-500">
									<?php echo $data['password_err']; ?>
								</span>
							</div>
							<a href="<?php echo URLROOT ;?>/users/register" class="text-sm ml-2 hover:text-pink-600 cursor-pointer">You don't have an account? Click here to create one...</a>
							<div class="relative">
								<button type="submit" value="Login"
									class="bg-pink-500 hover:bg-pink-600 text-white rounded-md px-2 py-1">Login</button>
							</div>


						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>

<!-- bg-pink-500 hover:bg-pink-600 -->
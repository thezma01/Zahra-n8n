Schema::table('users', function (Blueprint $table) {
    $table->string('two_factor_secret')->nullable();
    $table->string('two_factor_recovery_codes')->nullable();
});

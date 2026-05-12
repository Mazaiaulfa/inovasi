<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('library/bootstrap-social/bootstrap-social.css')); ?>">
<style>
    body {
        background: linear-gradient(135deg, #667eea, #764ba2);
        min-height: 100vh;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(8px);
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        padding: 2rem;
        max-width: 400px;
        width: 100%;
        margin-top: 90px;
    }

    .login-icon {
        font-size: 3rem;
        color: #4f46e5;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="login-card">
    
    <div class="login-brand text-center mb-3">
        <img src="<?php echo e(asset('img/logoLogin.png')); ?>" alt="Logo" style="height: 58px; width: auto;">
    </div>

    
    <?php if(session('status')): ?>
        <div class="alert alert-success text-center">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    
    <form method="POST" action="<?php echo e(route('login')); ?>" class="needs-validation" novalidate>
        <?php echo csrf_field(); ?>

        
        <div class="form-group mb-3">
            <label for="email" class="font-weight-bold"><i class="fas fa-envelope mr-1"></i> Email Team</label>
            <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                value="<?php echo e(old('email')); ?>" required autofocus placeholder="Masukkan Email Team">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback" style="display: block"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="form-group mb-2">
            <label for="password" class="font-weight-bold"><i class="fas fa-lock"></i> Password</label>
            <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                name="password" required placeholder="Masukkan Password">
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback" style="display: block"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="text-right mb-3">
            <?php if(Route::has('password.request')): ?>
                <a href="<?php echo e(route('password.request')); ?>" class="text-small">Lupa Password?</a>
            <?php endif; ?>
        </div>

        
        <button type="submit" class="btn btn-primary btn-lg btn-block">
            <i class="fas fa-sign-in-alt mr-1"></i> Log in
        </button>
    </form>

    
    <div class="text-center mt-3">
        <?php if(Route::has('register')): ?>
            <a href="<?php echo e(route('register')); ?>" class="text-small text-primary">
                <i class="fas fa-user-plus mr-1"></i> Belum Punya Akun?
            </a>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<!-- JS Libraries -->
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/auth/login.blade.php ENDPATH**/ ?>
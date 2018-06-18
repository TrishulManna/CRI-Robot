<?php $__env->startSection('content'); ?>
    <?php if( isset($robot) ): ?>
        <?php echo Form::model($robot, [
            'method' => 'PATCH',
            'id' => 'edit-database',
            'route' => ['robots.update', $robot->id]
        ]); ?>

    <?php else: ?>
        <?php echo Form::open([
            'method' => 'POST',
            'id' => 'edit-database',
            'route' => 'robots.store'
        ]); ?>

    <?php endif; ?>

    <div class="container">

        <div id="form-errors" style="color: red; font-weight: bold; padding-bottom: 5px;"></div>

        <div class="form-group">
            <?php echo Form::label('type', 'Type robot:', ['class' => 'control-label']); ?>

            <?php echo Form::text('type', null, ['class' => 'form-control']); ?>

        </div>

        <div class="form-group">
            <?php echo Form::label('name', 'Name of this robot:', ['class' => 'control-label']); ?>

            <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

        </div>

        <div class="form-group">
            <?php echo Form::label('version', 'Version:', ['class' => 'control-label']); ?>

            <?php echo Form::text('version', null, ['class' => 'form-control']); ?>

        </div>

        <div class="form-group">
            <?php echo Form::label('ostype', 'Operating System:', ['class' => 'control-label']); ?>

            <?php echo Form::text('ostype', null, ['class' => 'form-control']); ?>

        </div>

        <div class="form-group">
            <?php echo Form::label('osversion', 'OS Version:', ['class' => 'control-label']); ?>

            <?php echo Form::text('osversion', null, ['class' => 'form-control']); ?>

        </div>

        <div class="form-group">
            <?php echo Form::label('text', 'Description:', ['class' => 'control-label']); ?>

            <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => '5']); ?>

        </div>

         <div class="form-group">
            <?php if((bool)App\RoleUsers::where('user_id', Illuminate\Support\Facades\Auth::id())->where('role_id', 1)->first() || (bool)App\RoleUsers::where('user_id', Illuminate\Support\Facades\Auth::id())->where('role_id', 2)->first()): ?>
              <?php echo Form::label('text', 'Gebruiker:', ['class' => 'control-label']); ?>

              <?php echo Form::select('user_id', App\User::getUsersForSelect() , ['class' => 'form-control']); ?>

            <?php else: ?>
              <?php echo Form::label('text', 'Gebruiker:', ['class' => 'control-label']); ?>

              <?php echo Form::select('user_id', array(Illuminate\Support\Facades\Auth::id() => Illuminate\Support\Facades\Auth::user()->name) , ['class' => 'form-control', 'disabled', 'readonly']); ?>

            <?php endif; ?>
        </div>       

        <?php echo Form::submit('Save Robot', ['class' => 'btn btn-primary btn-block']); ?>


        <?php echo Form::close(); ?>


    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script>
        $("#edit-database").ajaxform( { form: 'Robot', index: "<?php echo e(route('robots.index')); ?>" } );

        $(document).ready(function() {
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
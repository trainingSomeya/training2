<div class="container"> 
    <div class="row"> 
        <div class="posts form box"> 
            <?php echo $this->Form->create('Changedata',array('inputDefaults'=>array('div'=>'form-group','class'=>'form-control'),'type' => 'file', 'enctype' => 'multipart/form-data')); ?> 
            <form> 
                <legend><?php echo __('Add Data', array('type' => 'file')); ?></legend> 
                        <?php echo $this->Form->input('Changedata.filename', array('type' => 'file','accept' => 'text/csv'));?>  
                <div class="form-group"> 
                    <?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary btn-lg')); ?>
                </div>
            </form>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

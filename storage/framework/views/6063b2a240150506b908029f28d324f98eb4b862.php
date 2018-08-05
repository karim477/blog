<?php $__env->startSection('content'); ?>
<div class="container" id="project">
        
        <div class="row">
            
            <div class="col-md-4">
                <div class="list-container">
                    <h2>ToDo</h2>
                    <div class="cards-list" id="list-todo" data-status="TODO">
                        <!-- data-id="CARD_DB_ID" -->
                        <div class="card" data-id="id-1">Card 1 (todo)</div>
                        <div class="card" data-id="id-2">Card 2 (todo)</div>
                        <div class="card" data-id="id-3">Card 3 (todo)</div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="list-container">
                    <h2>In Progress</h2>
                    <div class="cards-list" id="list-progress" data-status="IN_PROGRESS">
                        <div class="card" data-id="id-4">Card 1 (progress)</div>
                        <div class="card" data-id="id-5">Card 2 (progress)</div>
                        <div class="card" data-id="id-6">Card 3 (progress)</div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="list-container">
                    <h2>Done</h2>
                    <div class="cards-list" id="list-done" data-status="DONE">
                        <div class="card" data-id="id-7">Card 1 (done)</div>
                        <div class="card" data-id="id-8">Card 2 (done)</div>
                        <div class="card" data-id="id-9">Card 3 (done)</div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    
   
    <script>
        $( function() {
            var $lists = $(".cards-list");

            $lists.sortable({
                connectWith: ".cards-list",
                update: function (event, ui) {
                    var out = {};

                    $lists.each(function () {
                        out[$(this).data('status')] = $(this).sortable('toArray', {
                            attribute: 'data-id'
                        });
                    }).get();
                    
                    // Update PROJECT_ID with real project ID
                    // @http://api.jquery.com/jquery.ajax/
                    // $.ajax({
                    //     action: '/',
                    //     method: 'POST',
                    //     sucess: 
                    // })
                    
                  /*  $.ajax({
                        type: "POST",
                        url: '/project/update-cards',
                        data: {
                            projectId: 234987234, // INSERT PROJECT ID
                            order: JSON.stringify(out),
                        },
                        dataType: 'application/json'
                    }).done(function(response) {
                        if ( ! response.success) {
                            alert(response.error);
                        }
                    });*/
                } 
            });
        } );
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
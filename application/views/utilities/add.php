<div class="wrapper wrapper-content">
    <div class="row wrapper border-bottom white-bg page-heading crumbs">Add New Commercial Utility</div>
    <div id="mycontent">
        <div class="row">
            <div class="col-centered col-lg-6">
                <div class="ibox float-e-margins white-bg">
                    <form id="add_new_utility" class="form-horizontal" method="post">
                        <div class="col-lg-12">
                            <div class="form-group">

                                <label class="required">Name</label>
                                <input name="name" class="form-control" placeholder="Enter name"/>

                                <label class="required">Abbreviation</label>
                                <input name="abbreviation" class="form-control" placeholder="Enter abbreviation"/>

                                <label class="">Assign Inspector</label>
                                <select name="inspector" class="select2_demo_1 form-control">
                                    <option value="-1">None</option>
                                    <?php foreach ($inspectors as $inspector) :?>
                                        <?php if(!$this->ion_auth->is_admin($inspector->id)): ?>
                                            <option value="<?=$inspector->id;?>">
                                                <?= $inspector->last_name.' '.$inspector->first_name; ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach;?>
                                </select>

                                <h3></h3>

                                <a href="<?php echo base_url().'utility'?>" type="button"
                                   class="btn btn-sm btn-info pull-left col-sm-2">
                                    <i class="fa fa-caret-left"></i> Go Back
                                </a>

                                <div class="col-lg-7">
                                    <div class="errorresponse alert-danger" style="text-align:center;"></div>
                                    <div id="moment" style="text-align:center;"></div>
                                    <div id="response" class="alert-success" style="text-align:center;"></div>
                                </div>

                                <button class="btn btn-primary btn-sm pull-right col-sm-3" id="button"
                                        name="submit" type="submit"><i class="fa fa-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#add_new_utility").submit(function (e) {
            e.preventDefault();
            $("#moment").text("please wait...").fadeIn("slow");
            $("#moment").fadeOut();
            $("#response").fadeOut("slow");
            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>utility/create/',
                dataType: 'text',
                data: $("#add_new_utility").serialize(),
                timeout: 5000,
                success: function () {
                    $('#response').text("Created successfully.")
                        .hide()
                        .fadeIn(1500, function () {
                            $('#add_new_utility');
                            $("#response").fadeOut(7000);
                        });
                    window.location.href = "<?= base_url().'utility'?>";
                },
                error: function () {
                    $('.errorresponse').text("Something is going wrong...")
                        .hide()
                        .fadeIn(1500, function () {
                            $('.errorresponse');
                        });
                }
            });
            return false;
        });
    });
</script>
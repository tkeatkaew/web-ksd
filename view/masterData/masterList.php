<div class="card" >
    <div class="card-header">
        <h4 class="card-title"> Master Data  <?= isset($this->dataid) ? ' : ' . $this->dataid : '' ?></h4>
        <div class="heading-elements">
            <ul class="list-inline mb-0"> 
                <li><a data-action="expand"><i class="ft-maximize"></i></a></li> 
            </ul>
        </div>
    </div>
    <div class="card-content">
        <div class="card-body">
            <ul class="nav nav-tabs nav-linetriangle nav-justified">
                <?php
                $i = 1;
                foreach ($this->fn->REF as $key => $value) {
                    $active = "";
                    if (isset($this->dataid) && $this->dataid == $key) {
                        $active = "active";
                    }
                    ?>

                    <li class="nav-item">
                        <a href="<?= URL ?>masterdata/l/<?= $key ?>" class="nav-link <?= $active ?>"  > <?= $value['table_Description'] ?></a>
                    </li> 
                    <?php
                }
                ?>

            </ul>
            <?php
            if (!empty($this->dataid)) {
                ?>

                <div id="masterData">
                    <div style="padding: 20px;">
                        <h1 class="pageheader">
                            <button type="button" class="btn btn-info pull-right" id="openForm">
                                Create New <?= $this->dataid ?>  <i class="ft-plus"></i> </button>                  
                            <div class="clear"></div>
                        </h1>
                        <div>
                            <table class=" table datatable"  >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <?php
                                        $table = $this->fn->REF[$this->dataid];
                                        foreach ($table['field'] as $key => $value) {
                                            echo "<th>{$value['field_Description']}</th>";
                                        }
                                        ?>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                  echo  $pk = $table['pk'];
                                    $i = 1;
                                    foreach ($this->data as $key => $value) {
                                        ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <?php
                                            foreach ($table['field'] as $k => $v) {
                                                $field_name = $v['field_name'];
                                                echo "<td>{$value->$field_name}</td>";
                                            }
                                            
                                            ?>
                                            <td>                                            
                                                <a class="btn btn-xs btn-success btn-sm editFormOpen" data-id="<?= $value->$pk; ?>" href="<?= URL ?>masterdata/q/<?= $this->dataid ?>/<?= $value->$pk; ?>">แก้ไข</a>
                                                <a class="btn  btn-xs btn-danger btn-sm text-white RemoveItems" href="<?= URL ?>masterdata/d/<?= $this->dataid ?>/<?= $value->oid; ?>">ลบ</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> <?= $table['table_Description'] ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form  method="post" id="formSubmit"> 

                                    <?php
                                    foreach ($table['field'] as $key => $value) {
                                        ?>
                                        <div class="form-group">
                                            <label><?= $value['field_Description'] ?> <?php if (!empty($value['comment'])) { ?><div> <code>(<?= $value['comment'] ?>)</code></div> <?php } ?></label>
                                            <?php
                                            if ($value['field_type'] == 'input') {
                                                ?>
                                                <input type="text"  id="<?= $value['field_name'] ?>" name="<?= $value['field_name'] ?>" <?= $value['required'] ?>  placeholder="<?= $value['field_Description'] ?>"  class="form-control">
                                            <?php } else {
                                                ?>
                                                <textarea rows="5" id="<?= $value['field_name'] ?>" name="<?= $value['field_name'] ?>" <?= $value['required'] ?>  placeholder="<?= $value['field_Description'] ?>" class="form-control"></textarea>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <button type="submit" id="Submit1" style="display: none;"></button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" onclick="$('#Submit1').click();"> Save </button>
                            </div>
                        </div>
                    </div>
                </div> 


            <?php } else {
                ?>

                <h3 style="padding: 100px;text-align: center;">
                    <i class="ft-arrow-up"></i> <br/>
                    Please select some tap.</h3>
            <?php }
            ?>
        </div>
    </div>
</div>


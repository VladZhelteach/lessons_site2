</div>

    <div class="col-sm-8">
      <!--<h2>TITLE HEADING</h2>-->
      <p><?=$this->content?></p>
    <form action="<?php echo($_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/"); ?>admin/?page=new_post_submit" method="post">
        <input name="title" placeholder="Post title" style="width:100%" required  class="form-control"><br>
        <textarea type="text" name="txtarea" placeholder="Post text" style="width:100%;height:30vh" required></textarea><br>
        <input type="text" name="state" id="state" list="state_list"  required  class="form-control">
        <datalist id='state_list'>
        <option value='1'>draft</option>
        <option value='2'>published</option>
        <option value='3'>hidden</option>
        </datalist>
        <!--<input type='number' id='tentacles' name='tentacles' min='10' max='100' class="form-control">-->
        <input type="submit" value="Create new post" class="btn btn-primary">
        <input type="reset" value="Reset" class="btn btn-warning">
    </form>
    </div>
    </div>
</div>
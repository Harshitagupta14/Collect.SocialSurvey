<div class="form-group catlevel" id="catlevel_<?=$catlevel?>">
  <label class="col-md-3 col-xs-12 control-label">Category</label>
  <div class="col-md-6 col-xs-12">
    <select class="form-control select category_id" name="category_id[]">
      <option value="">Select Product category</option>
      <?php foreach ($category_list as $category) { ?>
      <option value="<?= $category['cat_id']?>"<?php if($category['cat_id']== $category_id) { ?> selected="selected" <?php }?>>
      <?= $category['category_title']?>
      </option>
      <?php }?>
    </select>
    <span class="help-block" style="color: red;">
    <?= strip_tags(form_error('category_id[]'))?>
    </span> </div>
</div>

<form>
    <tr>
        <th>titre</th>
        <th>chapo</th>
        <th>content</th>
    </tr>


    </tr>
    <tr><label>title<br /></label><input type="textarea" name="content" value="<?php echo $post->title ?>" size="250"  placeholder="<?php echo $post->id ?>" <tr/>
    </tr>
    <tr><label>header<br /></label><input type="textarea" name="content" value="<?php echo $post->header ?>" size="250"  placeholder="<?php echo $post->id ?>" <tr/>
    </tr>
    <tr><label>content<br /></label><input type="textarea" name="content" value="<?php echo $post->content ?>" size="250"  placeholder="<?php echo $post->id ?>" <tr/>
    </tr>
    <tr><label>updated<br /></label><input type="textarea" name="content" value="<?php echo $post->updated ?>" size="250"  placeholder="<?php echo $post->id ?>" <tr/>
    </tr>
    <tr><label>nickname<br /></label><input type="textarea" name="content" value="<?php echo $post->nickname_user ?>" size="250"  placeholder="<?php echo $post->id ?>" <tr/>
    </tr>


    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>

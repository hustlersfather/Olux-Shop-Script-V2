<form method="POST" action="cpanelMass.html" target="myifram">
    <div class="form-group">
        <label for="text">cPanel List:</label>
        <textarea name="inputs" class="form-control" rows="3" placeholder="http://www.website.com:2082/|username|password"></textarea>
    </div>
    <div class="form-group">
        <label for="price">Price:</label>
        <input placeholder="5" type="text" name="price" class="form-control" required="">
    </div>
    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-primary">Add <span class="glyphicon glyphicon-indent-left"></span></button>
        <input type="hidden" name="start" value="work" />
    </div>
</form>
<iframe style="border:none" width="100%" height="100%" scrolling="yes" name="myifram" id="myifram" src="cpanelMass.html"></iframe>
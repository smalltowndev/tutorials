<div class="wrap">
    <h1>Compress Images Settings</h1>
    <form method="post" action="">
        <label for="image">Select an Image:</label>
        <input type="file" id="image" name="image" accept="image/*"><br>

        <label for="quality">Select Quality:</label>
        <select id="quality" name="quality">
            <option value="low">Low</option>
            <option value="mid">Mid</option>
            <option value="high">High</option>
        </select><br>

        <input type="submit" name="compress" value="Compress Image">
    </form>
</div>
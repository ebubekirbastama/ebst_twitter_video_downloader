<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>EBS Twitter Video İndirici</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:#f8f9fa; padding:40px;">

<div class="container" style="max-width:600px;">
  <div class="card shadow p-4">
    <h3 class="text-center mb-4" style="font-weight:bold;">Twitter Video İndirici</h3>

    <form action="indir.php" method="POST">
      <div class="mb-3">
        <label for="url" class="form-label">Twitter Video URL:</label>
        <input type="text" name="url" class="form-control" id="url" placeholder="https://twitter.com/user/status/..." required />
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary" style="font-weight:bold;">🎥 Videoyu Hemen İndir</button>
      </div>
    </form>
  </div>
</div>

</body>
</html>

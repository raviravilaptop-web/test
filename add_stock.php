<?php require 'header.php'; ?>
<?php
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit; }
require 'config.php';

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();

// Handle form submission
if ($_POST) {
    $bill_date = $_POST['bill_date'];
    $item_code = strtoupper(trim($_POST['item_code']));
    $category_id = $_POST['category'];
    $item_name = trim($_POST['item_name']);
    $quantity = (int)$_POST['quantity'];
    $entry_date = date('Y-m-d');

    // Check if item_code already exists
    $stmt = $pdo->prepare("SELECT id, total_quantity, available_quantity FROM stock WHERE item_code = ?");
    $stmt->execute([$item_code]);
    $existing = $stmt->fetch();

    if ($existing) {
        // Update existing record: add to total and available quantity
        $new_total = $existing['total_quantity'] + $quantity;
        $new_available = $existing['available_quantity'] + $quantity;

        $update = $pdo->prepare("UPDATE stock SET 
            total_quantity = ?, 
            available_quantity = ?, 
            bill_date = ?, 
            entry_date = ?, 
            item_name = ?, 
            category_id = ? 
            WHERE item_code = ?");
        $update->execute([$new_total, $new_available, $bill_date, $entry_date, $item_name, $category_id, $item_code]);

        $message = "Stock updated successfully! New total: $new_total";
    } else {
        // Insert new record
        $serial = $pdo->query("SELECT COALESCE(MAX(serial), 0) + 1 FROM stock")->fetchColumn();
        $stmt = $pdo->prepare("INSERT INTO stock (serial, bill_date, entry_date, item_code, category_id, item_name, total_quantity, available_quantity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$serial, $bill_date, $entry_date, $item_code, $category_id, $item_name, $quantity, $quantity]);
        $message = "New stock added successfully!";
    }

    echo "<script>alert('$message'); window.location.href='view_stock.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h5><i class="fas fa-plus"></i> Add / Update Stock</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Bill Date</label>
                        <input type="date" name="bill_date" class="form-control" required value="<?=date('Y-m-d')?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Item Code <span class="text-danger">*</span></label>
                        <input type="text" name="item_code" class="form-control" required placeholder="e.g. PEN001" style="text-transform: uppercase;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select" required>
                            <option value="">Select Category</option>
                            <?php foreach($categories as $c): ?>
                                <option value="<?=$c['id']?>"><?=$c['name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Item Name</label>
                        <input type="text" name="item_name" class="form-control" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Quantity to Add</label>
                        <input type="number" name="quantity" class="form-control" min="1" required placeholder="Enter quantity">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Save / Update Stock
                    </button>
                    <a href="view_stock.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Stock
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<?php require 'footer.php'; ?>
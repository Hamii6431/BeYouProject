<?php
include '../../Backend/includes/session.php';
include '../../Backend/includes/connect.php';



if(isset($_GET['types']) || isset($_GET['colors']) || isset($_GET['materials'])) {
    $types = isset($_GET['types']) ? implode(",", $_GET['types']) : '';
    $colors = isset($_GET['colors']) ? implode(",", $_GET['colors']) : '';
    $materials = isset($_GET['materials']) ? implode(",", $_GET['materials']) : '';

    // Charmok szűrése
    $braceletTypeCondition = 'type_Name = <Bracelet>';

    if(!empty($types) && !empty($colors) && !empty($materials)) {
        $sql = "SELECT * FROM products WHERE $braceletTypeCondition AND type_ID IN ($types) AND color_ID IN ($colors) AND material_ID IN ($materials)";
    } elseif(!empty($types) && !empty($colors)) {
        $sql = "SELECT * FROM products WHERE $braceletTypeCondition AND type_ID IN ($types) AND color_ID IN ($colors)";
    } elseif(!empty($types) && !empty($materials)) {
        $sql = "SELECT * FROM products WHERE $braceletTypeCondition AND type_ID IN ($types) AND material_ID IN ($materials)";
    } elseif(!empty($colors) && !empty($materials)) {
        $sql = "SELECT * FROM products WHERE $braceletTypeCondition AND color_ID IN ($colors) AND material_ID IN ($materials)";
    } elseif(!empty($types)) {
        $sql = "SELECT * FROM products WHERE $braceletTypeCondition AND type_ID IN ($types)";
    } elseif(!empty($colors)) {
        $sql = "SELECT * FROM products WHERE $braceletTypeCondition AND color_ID IN ($colors)";
    } elseif(!empty($materials)) {
        $sql = "SELECT * FROM products WHERE $braceletTypeCondition AND material_ID IN ($materials)";
    } else {
        $sql = "SELECT * FROM products WHERE $braceletTypeCondition";
    }
} else {
    // Charmok szűrése
    $braceletTypeCondition = 'type_Name = <Bracelet>';
    $sql = "SELECT * FROM products WHERE $braceletTypeCondition";
}

$result = $con->query($sql);
$filteredProducts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $filteredProducts[] = [
            'name' => $row['product_name'],
            'price' => $row['price'],
            'image' => $row['image'],
            'id' => $row['product_ID'],
            'type' => $row['type_ID'],
            'color' => $row['color_ID'],
            'material' => $row['material_ID'],
        ];
    }
}

$con->close();

echo json_encode($filteredProducts);
?>
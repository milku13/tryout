<?php 
 include "../koneksi.php";

 if(isset($_POST['id_suplier'])){
    $id_suplier = $_POST['id_suplier'];

    $result = mysqli_query($conn,"SELECT * FROM produk WHERE suplier_id = '$id_suplier'");

    if($result){
        while($data = mysqli_fetch_assoc($result)){
            echo "<tr>
            <td>{$data['nama_produk']}</td>
            <td id='harga{$data['nama_produk']}'>{$data['harga_jual']}</td>
            <td><input type='number' id='qty{$data['nama_produk']}' name='qty{$data['nama_produk']}' min='0' style='width:60px;' harga='{$data['harga_jual']}' onchange='updateQty(this)'></td>
            <td><input type='checkbox' class='selectProduct' harga='{$data['harga_jual']}' id='chk{$data['nama_produk']}' name='selectProduct[]' value='{$data['nama_produk']}' onchange='updateQty(this)'></td>
          </tr>";
        }
    }
 }

?>

<tr>
    <td><input type="number" class="chosen-product-id" name="product_id" value="<?=$product->getId()?>" style="width: 50%;" disabled></td>
    <td><?=$product->getName()?></td>
    <td><?=number_format($product->getPrice())?></td>
    <td><input type="number" name="qty" value="" style="width: 70%;" required></td>
    <td>
        <select class="form-control select2" name="size" style="width: 110%;" onchange="updateQtyOfSize(this, <?=$product->getId()?>)">
            <option value=""></option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
        </select>
    </td>
    <td class="quantity-in-stock-of-<?=$product->getId()?>"></td>
    <td><a href="javascript:void(0)" class="btn btn-danger btn-sm btn-delete">Xóa</a></td>
</tr>



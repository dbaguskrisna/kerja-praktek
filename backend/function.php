<?php
$conn = mysqli_connect("localhost", "root", "", "coba");
function query($query)
{
    global $conn; //untuk mengambil variable mysqli diatas
    $result = mysqli_query($conn, $query); //untuk melakukan queery
    $rows = []; //tempat untuk menampung row

    if (empty($result)) {
        return false;
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row; //untuk menambahkan elemen baru ke tiap array kayak 1 1 masuknya
        }
        return $rows;
    }
}

function chart($query)
{
    global $conn; //untuk mengambil variable mysqli diatas
    $result = mysqli_query($conn, $query); //untuk melakukan queery
    $rows = []; //tempat untuk menampung row

    if (empty($result)) {
        return false;
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row; //untuk menambahkan elemen baru ke tiap array kayak 1 1 masuknya
        }
    }
    echo json_encode($rows);
}

function insertSupplier($ship)
{
    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $namaSupplier = $_POST['namaSupplier'];
    $alamat = $_POST['alamat'];
    $noHP = $_POST['noHp'];

    $sql = "INSERT INTO supplier (nama_supplier, alamat, no_hp)VALUES('$namaSupplier', '$alamat', '$noHP')";

    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Menambahkan data supplier sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
        header("refresh: 3;");
    }
}

function updateSupplier($data)
{

    global $conn; //untuk connect ke database
    $id = $_POST['idSupplier'];
    $namaSupp = $_POST['namaSupplier'];
    $alamat = $_POST['alamat'];
    $noHp = $_POST['nomorHP'];

    $sql = "UPDATE supplier SET nama_supplier = '$namaSupp', alamat = '$alamat', no_hp='$noHp' WHERE id_supplier = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Update data supplier sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
        header("refresh: 3;");
    }
}

function deleteSupplier($data)
{
    global $conn; //untuk connect ke database
    $id = $_POST['idSupplier'];
    $sql = "DELETE FROM supplier WHERE id_supplier=$id";

    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Update data supplier sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
        header("refresh: 3;");
    }
}

function insertUser($user)
{
    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $username = $_POST['username'];
    $password = md5(md5('alvian' . $_POST['password']));
    $jabatan = $_POST['jabatan'];
    $decrypt = $_POST['password'];

    $sql = "INSERT INTO user (email, password, jabatan, decrypt)VALUES('$username', '$password', '$jabatan', '$decrypt')";

    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Menambahkan data user sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
        header("refresh: 3;");
    }
}

function updateUser($user)
{
    global $conn; //untuk connect ke database
    $id = $_POST['idUpdate'];
    $username = $_POST['usernameUpdate'];
    $password = md5(md5('alvian' . $_POST['passwordUpdate']));
    $jabatan = $_POST['jabatanUpdate'];
    $decrypt = $_POST['passwordUpdate'];

    $sql = "UPDATE user SET email = '$username', password = '$password', jabatan='$jabatan', decrypt='$decrypt' WHERE id_user = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Update data user sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
        header("refresh: 3;");
    }
}

function deleteUser($data)
{
    global $conn; //untuk connect ke database
    $id = $_POST["idDelete"];
    $sql = "DELETE FROM user WHERE id_user=$id";

    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Delete data user sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
        header("refresh: 3;");
    }
}

function insertSupplierPayment($data)
{
    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $tanggal = $_POST['tanggal'];
    $namaSupplier = $_POST['supplier'];
    $jumlahTransfer = $_POST['jumlahTransfer'];
    $bank = $_POST['bank'];
    $totalBarang = $_POST['totalBarang'];
    $gradeBarang = $_POST['gradeBarang'];
    $statusPembayaran = $_POST['statusPembayaran'];

    $sql = "INSERT INTO pembayaran_supplier (jumlah_pembayaran, tanggal, total_barang,status_pembayaran,grade_barang,bank,supplier_id_supplier)VALUES ('$jumlahTransfer', '$tanggal', '$totalBarang', '$statusPembayaran', '$gradeBarang','$bank','$namaSupplier')";

    if (mysqli_query($conn, $sql)) {
        header("Refresh:3");
        echo "
            <div class='alert alert-success text-center' role='alert'>
                Update data user sukses
            </div>
                ";
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>
                Delete data user gagal
            </div>
            ";
    }
}

function updateSupplierPayment($data)
{
    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $tanggal = $_POST['tanggal'];
    $id = $_POST['id'];
    $jumlahTransfer = $_POST['jumlahTransfer'];
    $bank = $_POST['bank'];
    $totalBarang = $_POST['totalBarang'];
    $gradeBarang = $_POST['gradeBarang'];
    $statusPembayaran = $_POST['statusPembayaran'];

    $sql = "UPDATE pembayaran_supplier SET jumlah_pembayaran = '$jumlahTransfer', tanggal = '$tanggal', total_barang='$totalBarang', status_pembayaran='$statusPembayaran', grade_barang='$gradeBarang', bank='$bank' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Delete data user sukses
                </div>
            ";
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
    }
}

function deleteSupplierPayment($data)
{
    global $conn; //untuk connect ke database
    $id = $_POST["id"];
    $sql = "DELETE FROM pembayaran_supplier WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Refresh:2");
        echo "
            <div class='alert alert-success text-center' role='alert'>
                Delete data user sukses
            </div>
                ";
    } else {

        echo "
            <div class='alert alert-danger text-center' role='alert'>
                Delete data user gagal
            </div>
            ";
    }
}

function insertKapal($data)
{
    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $namaKapal = $_POST['namaKapal'];
    $noKapal = $_POST['nomorKapal'];

    $sql = "INSERT INTO kapal (nama_kapal,nomor_kapal) VALUES ('$namaKapal', '$noKapal')";

    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Tambah data kapal sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
    }
}

function updateKapal($data)
{
    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id = $_POST['idUpdate'];
    $namaKapal = $_POST['namaKapal'];
    $noKapal = $_POST['nomorKapal'];

    $sql = "UPDATE kapal SET nama_kapal = '$namaKapal', nomor_kapal = '$noKapal' WHERE id_kapal = '$id'";

    if (mysqli_query($conn, $sql)) {
        header("Refresh:3");
        echo "
            <div class='alert alert-success text-center' role='alert'>
                Update data kapal sukses
            </div>
                ";
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
    }
}

function deleteKapal($data)
{
    global $conn; //untuk connect ke database
    $id = $_POST["idDelete"];
    $sql = "DELETE FROM kapal WHERE id_kapal=$id";

    if (mysqli_query($conn, $sql)) {
        header("Refresh:3");
        echo "
            <div class='alert alert-success text-center' role='alert'>
                Menghapus data kapal sukses
            </div>
                ";
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
    }
}

function insertStockin($data)
{
    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $noNota = $_POST['noNota'];
    $tanggal = $_POST['tanggal'];
    $truck = $_POST['truck'];
    $kontainer = $_POST['kontainer'];

    $checkNota = mysqli_query($conn, "SELECT * FROM pembayaran_supplier WHERE id_pembayaran = '$noNota'");

    if (mysqli_num_rows($checkNota) === 1) {
        $rowNota = mysqli_fetch_assoc($checkNota);
        $colyNota =  intval($rowNota['coly']);
        $grossNota =  intval($rowNota['gross']);
        $nettoNota =  intval($rowNota['netto']);
        $namaBarangNota = $rowNota['nama'];
        $jenisBarangNota = $rowNota['jenis_barang'];
        $gradeNota = $rowNota['grade'];
        $asalNota = $rowNota['asal'];

        $sql = "INSERT INTO barang_masuk (tanggal,truck,coly,gross,netto,id_pembayaran_supplier,id_kontainer,nama,jenis_barang,grade,asal) VALUES ('$tanggal', '$truck', '$colyNota', '$grossNota', '$nettoNota', '$noNota', '$kontainer', '$namaBarangNota', '$jenisBarangNota','$gradeNota','$asalNota')";

        $checkBarang = mysqli_query($conn, "SELECT * FROM master_barang WHERE nama = '$namaBarangNota' AND grade = '$gradeNota' AND jenis_barang ='$jenisBarangNota'");

        if (mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($checkBarang) === 1) {
                $row = mysqli_fetch_assoc($checkBarang); // mysqli_fetch_assoc digunakan untuk menggambil data dari querry result dan 
                $stok = intval($row['stok']);
                $stok = $stok + $nettoNota;
                $update = "UPDATE master_barang SET stok = '$stok' WHERE nama = '$namaBarangNota' AND grade = '$gradeNota'";
                $updateStatusNota = "UPDATE pembayaran_supplier SET status_nota = '1' WHERE id_pembayaran = '$noNota'";
                if (mysqli_query($conn, $update)) {
                    if (mysqli_query($conn, $updateStatusNota)) {
                        header("Refresh:3");
                        echo "
                            <div class='alert alert-success text-center' role='alert'>
                                Tambah Stok Berhasil
                            </div>
                                ";
                    } else {
                        echo "
                            <div class='alert alert-danger text-center' role='alert'>" .
                            $updateStatusNota . "<br>" . mysqli_error($conn)
                            . "</div>";
                    }
                } else {
                    echo "
                    <div class='alert alert-danger text-center' role='alert'>" .
                        $update . "<br>" . mysqli_error($conn)
                        . "</div>";
                }
            } else {
                $insert_master_barang = "INSERT INTO master_barang (nama,jenis_barang,grade,asal,stok) VALUES ('$namaBarangNota', '$jenisBarangNota', '$gradeNota', '$asalNota', '$nettoNota')";
                if (mysqli_query($conn, $insert_master_barang)) {
                    header("Refresh:3");
                    echo "
                    <div class='alert alert-success text-center' role='alert'>
                        Update stok barang berhasil
                    </div>
                        ";
                } else {
                    echo "
                    <div class='alert alert-danger text-center' role='alert'>" .
                        $insert_master_barang . "<br>" . mysqli_error($conn)
                        . "</div>";
                }
            }
        } else {
            echo "
            <div class='alert alert-danger text-center' role='alert'>" .
                $sql . "<br>" . mysqli_error($conn)
                . "</div>";
        }
    } else {
        echo "
        <div class='alert alert-success text-center' role='alert'>
            ERROR
        </div>
            ";
    }
}

function updateStockin($data)
{
    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $idEdit = $_POST['idUpdate'];
    $truck = $_POST['truck'];
    $kontainer = $_POST['kontainer'];

    $sql = "UPDATE barang_masuk SET truck = '$truck', id_kontainer = '$kontainer' WHERE id_barang_masuk = '$idEdit'";
    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Update data customer sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
    }
}

function deleteStockin($data)
{
    global $conn; //untuk connect ke database
    $id = $_POST['idDelete'];
    $sql = "DELETE FROM barang_masuk WHERE id_barang_masuk=$id";

    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Delete data barang masuk sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
        header("refresh: 3;");
    }
}

function insertStockout($data)
{
    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $tanggal = $_POST['tanggal'];
    $contractno = $_POST['contract_no'];
    $consigne = $_POST['consigne'];
    $notifyParty = $_POST['notify_party'];
    $portofloading = $_POST['port_of_loading'];
    $countryoforigin = $_POST['country_of_origin'];
    $destination = $_POST['destination'];
    $description = $_POST['description'];
    $packing = $_POST['packing'];
    $freight = $_POST['freight'];
    $notaPembayaran = $_POST['nota_pembayaran'];
    $id_kapal = $_POST['kapal'];
    $kontainer = $_POST['kontainer'];

    $checkNota = mysqli_query($conn, "SELECT * FROM pembayaran_customer WHERE id_pembayaran = '$notaPembayaran'");

    if (mysqli_num_rows($checkNota) === 1) {
        $rowNota = mysqli_fetch_assoc($checkNota);
        $colyNota =  intval($rowNota['coly']);
        $grossNota =  intval($rowNota['gross']);
        $nettoNota =  intval($rowNota['netto']);
        $namaBarangNota = $rowNota['nama_barang'];
        $jenisBarangNota = $rowNota['jenis_barang'];
        $gradeNota = $rowNota['grade'];

        $checkMasterBarang = mysqli_query($conn, "SELECT * FROM master_barang WHERE nama='$namaBarangNota' AND jenis_barang='$jenisBarangNota' AND grade='$gradeNota'");

        if (mysqli_num_rows($checkMasterBarang) === 1) {
            $rowBarang = mysqli_fetch_assoc($checkMasterBarang);
            $idMasterBarang = $rowBarang['id_barang'];

            $sql = "INSERT INTO barang_keluar (tanggal,contract_no,consigne,notify_party,port_of_loading,country_of_origin,destination,description,packing,freight,id_barang,id_kapal,id_pembayaran_customer,id_kontainer,gross_weight,no_of_bags,net_weight) VALUES ('$tanggal', '$contractno', '$consigne', '$notifyParty', '$portofloading', '$countryoforigin', '$destination', '$description', '$packing','$freight','$idMasterBarang', '$id_kapal','$notaPembayaran','$kontainer','$grossNota','$colyNota','$nettoNota')";

            $checkBarang = mysqli_query($conn, "SELECT * FROM master_barang WHERE id_barang = $idMasterBarang");

            if (mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($checkBarang) === 1) {
                    $row = mysqli_fetch_assoc($checkBarang); // mysqli_fetch_assoc digunakan untuk menggambil data dari querry result dan 
                    $stok = intval($row['stok']);
                    if ($nettoNota >= $stok) {
                        echo "
                    <div class='alert alert-warning text-center' role='alert'>
                        Tidak dapat melakukan pengiriman karena pengiriman melibihi stock gudang
                    </div>
                    ";
                    } else {
                        $stok = $stok - $nettoNota;
                        $update = "UPDATE master_barang SET stok = '$stok' WHERE id_barang = $idMasterBarang";

                        if (mysqli_query($conn, $update)) {
                            echo "
                            <div class='alert alert-success text-center' role='alert'>
                                Stock Out Berhasil barang berhasil
                            </div>
                            ";
                            header("Refresh:3");
                        } else {
                            echo "
                        <div class='alert alert-danger text-center' role='alert'>" .
                                $update . "<br>" . mysqli_error($conn)
                                . "</div>";
                        }
                    }
                } else {
                    echo "
                <div class='alert alert-danger text-center' role='alert'>
                    Error
                </div>";
                }
            } else {
                echo "
            <div class='alert alert-danger text-center' role='alert'>" .
                    $sql . "<br>" . mysqli_error($conn)
                    . "</div>";
            }
        }
    }
}

function updateStockout($data)
{
    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id_update_stock_out = $_POST['idUpdate'];
    $tanggal = $_POST['tanggal'];
    $contractno = $_POST['contract_no'];
    $consigne = $_POST['consigne'];
    $notifyParty = $_POST['notify_party'];
    $portofloading = $_POST['port_of_loading'];
    $countryoforigin = $_POST['country_of_origin'];
    $destination = $_POST['destination'];
    $description = $_POST['description'];
    $packing = $_POST['packing'];
    $freight = $_POST['freight'];
    $id_barang = $_POST['nama_barang'];
    $notaPembayaran = $_POST['nota_pembayaran'];
    $id_kapal = $_POST['kapal'];
    $kontainer = $_POST['kontainer'];
    $netWeight = $_POST['netWeight'];
    $grossWeight = $_POST['grossWeight'];
    $noOfWeight = $_POST['noOfBags'];
    $netWeight2 = $_POST['netWeight2'];

    $sql = "UPDATE barang_keluar SET tanggal = '$tanggal', contract_no = '$contractno',consigne ='$consigne',notify_party='$notifyParty', port_of_loading = '$portofloading',country_of_origin = '$countryoforigin', destination = '$destination',description = '$description', packing = '$packing',freight = '$freight',id_barang  = '$id_barang', id_kapal  = '$id_kapal',id_pembayaran_customer  = '$notaPembayaran',id_kontainer ='$kontainer',net_weight='$netWeight',gross_weight='$grossWeight',no_of_bags = '$noOfWeight' WHERE id_barang_keluar = '$id_update_stock_out'";

    $checkBarang = mysqli_query($conn, "SELECT * FROM master_barang WHERE id_barang = $id_barang");

    if (mysqli_query($conn, $sql)) {
        $row = mysqli_fetch_assoc($checkBarang); // mysqli_fetch_assoc digunakan untuk menggambil data dari querry result dan 
        $stok = intval($row['stok']);
        $netto2 = intval($netWeight2);
        $stokBaru = ($stok - $netto2) + $noOfWeight;

        $update = "UPDATE master_barang SET stok = '$stokBaru' WHERE id_barang = '$id_update_stock_out'";
        if (mysqli_query($conn, $update)) {
            if (mysqli_query($conn, $sql)) {
                header("refresh: 3;");
                echo "
                    <div class='alert alert-success text-center' role='alert'>
                        Update stok barang berhasil
                    </div>
                    ";
            } else {
                echo "
                    <div class='alert alert-danger text-center' role='alert'>" .
                    $update . "<br>" . mysqli_error($conn)
                    . "</div>";
            }
        } else {
            echo "
                <div class='alert alert-danger text-center' role='alert'>" .
                $update . "<br>" . mysqli_error($conn)
                . "</div>";
        }
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
        header("refresh: 3;");
    }
}

function deleteStockout($data)
{
    global $conn; //untuk connect ke database
    $id = $_POST["idDelete"];
    $sql = "DELETE FROM barang_keluar WHERE id_barang_keluar=$id";

    if (mysqli_query($conn, $sql)) {
        header("Refresh:3");
        echo "
            <div class='alert alert-success text-center' role='alert'>
                Delete data Stock in sukses
            </div>
            ";
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>
                Delete data Stock in gagal
            </div>
            ";
    }
}

function returnStockout($data)
{
    global $conn; //untuk connect ke database
    $id = $_POST["idReturn"];
    $id_barang = $_POST['idMasterBarang'];
    $stok = $_POST['netBarangReturn'];
    $updateStatus = "UPDATE barang_keluar SET status = '1' WHERE id_barang_keluar = '$id'";
    $checkBarang = mysqli_query($conn, "SELECT * FROM master_barang WHERE id_barang = '$id_barang'");

    if (mysqli_query($conn, $updateStatus)) {
        $row = mysqli_fetch_assoc($checkBarang); // mysqli_fetch_assoc digunakan untuk menggambil data dari querry result dan 
        $stokMaster = intval($row['stok']);
        $IntStok = intval($stok);
        $stokBaru = $IntStok + $stokMaster;

        $update = "UPDATE master_barang SET stok = '$stokBaru' WHERE id_barang = $id_barang";
        if (mysqli_query($conn, $update)) {
            header("Refresh:3");
            echo "
                <div class='alert alert-success text-center' role='alert'>
                    Return data berhasil
                </div>
                    ";
        } else {
            echo "
                <div class='alert alert-danger text-center' role='alert'>
                    Return data stock gagal
                </div>
                ";
        }
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $checkBarang . "<br>" . mysqli_error($conn)
            . "</div>";
        header("refresh: 3;");
    }
}

function cancelStockOut($data)
{
    global $conn; //untuk connect ke database
    $id = $_POST["idReturn"];
    $id_barang = $_POST['idMasterBarang'];
    $stok = $_POST['netBarangReturn'];
    $updateStatus = "UPDATE barang_keluar SET status = '0' WHERE id_barang_keluar = '$id'";
    $checkBarang = mysqli_query($conn, "SELECT * FROM master_barang WHERE id_barang = '$id_barang'");

    if (mysqli_query($conn, $updateStatus)) {
        $row = mysqli_fetch_assoc($checkBarang); // mysqli_fetch_assoc digunakan untuk menggambil data dari querry result dan 
        $stokMaster = intval($row['stok']);
        $IntStok = intval($stok);
        $stokBaru = $stokMaster - $IntStok;

        $update = "UPDATE master_barang SET stok = '$stokBaru' WHERE id_barang = $id_barang";
        if (mysqli_query($conn, $update)) {
            header("Refresh:3");
            echo "
                <div class='alert alert-success text-center' role='alert'>
                    Return data berhasil
                </div>
                    ";
        } else {
            echo "
                <div class='alert alert-danger text-center' role='alert'>
                    Return data stock gagal
                </div>
                ";
        }
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $checkBarang . "<br>" . mysqli_error($conn)
            . "</div>";
        header("refresh: 3;");
    }
}

function insertKontainer($data)
{
    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $namaKontainer = $_POST['namaKontainer'];
    $nomorKontainer = $_POST['nomorKontainer'];

    $sql = "INSERT INTO kontainer (nama_kontainer,nomor_seal) VALUES ('$namaKontainer', '$nomorKontainer')";

    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Tambah data kontainer sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
    }
}

function updateKontainer($data)
{
    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id = $_POST['idUpdate'];
    $namaKapal = $_POST['namaKontainer'];
    $noKapal = $_POST['nomorSeal'];

    $sql = "UPDATE kontainer SET nama_kontainer = '$namaKapal', nomor_seal = '$noKapal' WHERE id_kontainer = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Update data kontainer sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
    }
}

function deleteKontainer($data)
{
    global $conn; //untuk connect ke database
    $id = $_POST["idDelete"];
    $sql = "DELETE FROM kontainer WHERE id_kontainer=$id";

    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Delete data kontainer sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
    }
}

function insertCustomerData($data)
{
    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nomor_telp = $_POST['nomor'];
    $negara = $_POST['negara'];
    $kodePos = $_POST['kodePos'];
    $email = $_POST['email'];

    $sql = "INSERT INTO customer (nama,alamat,nomor_telp,negara,kodepos,email) VALUES ('$nama', '$alamat', '$nomor_telp','$negara','$kodePos','$email')";

    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Tambah data customer 
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
    }
}

function updateCustomerData($data)
{
    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $idUpdate = $_POST['idUpdate'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nomor_telp = $_POST['nomor'];
    $negara = $_POST['negara'];
    $kodePos = $_POST['kodePos'];
    $email = $_POST['email'];

    $sql = "UPDATE customer SET nama = '$nama', alamat = '$alamat', nomor_telp='$nomor_telp', negara='$negara', kodepos='$kodePos', email='$email' WHERE id_customer = '$idUpdate'";
    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Update data customer sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
    }
}

function deleteCustomerData($data)
{
    global $conn; //untuk connect ke database
    $id = $_POST["idDelete"];
    $sql = "DELETE FROM customer WHERE id_customer=$id";

    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Delete data customer sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
    }
}

function insertPembayaranSupplier($user)
{
    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $nomor_nota = $_POST['nomorNota'];
    $tanggal = $_POST['tanggal'];
    $jumlah_pembayaran = $_POST['jumlahPembayaran'];
    $total_barang = $_POST['totalBarang'];
    $status_pembayaran = $_POST['statusPembayaran'];
    $bank = $_POST['bank'];
    $supplier = $_POST['supplier'];
    $nama_barang = $_POST['namaBarang'];
    $jenis_barang = $_POST['jenisBarang'];
    $grade_barang = $_POST['gradeBarang'];
    $asal = $_POST['asalBarang'];
    $coly = $_POST['coly'];
    $gross = $_POST['gross'];
    $netto = $_POST['netto'];

    $sql = "INSERT INTO pembayaran_supplier (nomor_nota, tanggal, jumlah_pembayaran, total_barang,status_pembayaran,bank,supplier_id_supplier,nama,jenis_barang,grade,asal,coly,gross,netto)VALUES('$nomor_nota', '$tanggal', '$jumlah_pembayaran', '$total_barang','$status_pembayaran','$bank','$supplier', '$nama_barang','$jenis_barang','$grade_barang','$asal','$coly','$gross','$netto')";

    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Menambahkan data pembayaran supplier sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
    }
}

function updatePembayaranSupplier($user)
{

    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id_pembayaran = $_POST['idPembayaran'];
    $nomor_nota = $_POST['nomorNota'];
    $tanggal = $_POST['tanggal'];
    $jumlah_pembayaran = $_POST['jumlahPembayaran'];
    $total_barang = $_POST['totalBarang'];
    $status_pembayaran = $_POST['statusPembayaran'];
    $bank = $_POST['bank'];
    $supplier = $_POST['supplier'];
    $nama_barang = $_POST['namaBarang'];
    $jenis_barang = $_POST['jenisBarang'];
    $grade_barang = $_POST['grade'];
    $asal = $_POST['asalBarang'];

    $sql = "UPDATE pembayaran_supplier SET nomor_nota = '$nomor_nota', tanggal = '$tanggal', jumlah_pembayaran='$jumlah_pembayaran', total_barang='$total_barang', status_pembayaran='$status_pembayaran', bank='$bank', supplier_id_supplier = '$supplier', nama='$nama_barang', jenis_barang='$jenis_barang', grade='$grade_barang', asal='$asal' WHERE id_pembayaran = '$id_pembayaran'";

    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Update data pembayaran supplier sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
    }
}

function deletePembayaranSupplier($data)
{
    global $conn; //untuk connect ke database
    $id = $_POST["idDelete"];
    $sql = "DELETE FROM pembayaran_supplier WHERE id_pembayaran=$id";

    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Delete data pembayaran supplier sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
    }
}

function insertCustomerPayment($user)
{
    //Isi kodingan disini bisa copas kodingan dari function insert pembayaran supplier (tinggal di edit)
    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $jumlah_pembayaran = preg_replace("/[^0-9]/", "", $_POST['jumlahPembayaran']);
    $tanggal = $_POST['tanggal'];
    $bank = $_POST['bank'];
    $status_pembayaran = $_POST['statusPembayaran'];
    $customer = $_POST['customer'];
    $nomor_nota = $_POST['nomorNota'];
    $nama_barang = $_POST['namaBarang'];
    $jenis_barang = $_POST['jenisBarang'];
    $grade = $_POST['gradeBarang'];
    $coly = $_POST['coly'];
    $gross = $_POST['gross'];
    $netto = $_POST['netto'];

    $sql = "INSERT INTO pembayaran_customer (jumlah_pembayaran, tanggal,bank,status_pembayaran,customer_id,nomor_nota,nama_barang,jenis_barang,grade,coly,gross,netto)VALUES('$jumlah_pembayaran', '$tanggal','$bank','$status_pembayaran','$customer','$nomor_nota', '$nama_barang','$jenis_barang','$grade','$coly','$gross','$netto')";

    if (mysqli_query($conn, $sql)) {
        echo "
            <div class='alert alert-success text-center' role='alert'>
                Menambahkan Data Pembayaran Customer Berhasil
            </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
    }
}

function updateCustomerPayment($user)
{
    //Isi kodingan disini bisa copas kodingan dari function update pembayaran supplier (tinggal di edit)
    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id_pembayaran = $_POST['idPembayaran'];
    $jumlah_pembayaran = $_POST['jumlahPembayaran'];
    $tanggal = $_POST['tanggal'];
    $bank = $_POST['bank'];
    $status_pembayaran = $_POST['statusPembayaran'];
    $customer = $_POST['customer'];
    $nomor_nota = $_POST['nomorNota'];
    $nama_barang = $_POST['namaBarang'];
    $jenis_barang = $_POST['jenisBarang'];
    $grade = $_POST['grade'];
    $coly = $_POST['coly'];
    $gross = $_POST['gross'];
    $netto = $_POST['netto'];

    $sql = "UPDATE pembayaran_customer SET jumlah_pembayaran='$jumlah_pembayaran',tanggal = '$tanggal', bank='$bank', status_pembayaran='$status_pembayaran', customer_id  = '$customer', nomor_nota = '$nomor_nota',nama_barang='$nama_barang', jenis_barang='$jenis_barang', grade='$grade', coly='$coly', gross='$gross', netto='$netto' WHERE id_pembayaran = '$id_pembayaran'";

    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Update data pembayaran costumer sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
    }
}

function deleteCustomerPayment($data)
{
    //Isi kodingan disini bisa copas kodingan dari function delete pembayaran supplier (tinggal di edit)
    global $conn; //untuk connect ke database
    $id = $_POST["idDelete"];
    $sql = "DELETE FROM pembayaran_customer WHERE id_pembayaran=$id";

    if (mysqli_query($conn, $sql)) {
        echo "
                <div class='alert alert-success text-center' role='alert'>
                    Delete data pembayaran customer sukses
                </div>
            ";
        header("refresh: 3;");
    } else {
        echo "
            <div class='alert alert-danger text-center' role='alert'>" .
            $sql . "<br>" . mysqli_error($conn)
            . "</div>";
    }
}

function downGrade($data)
{
    global $conn;
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $idBarang = $_POST['idDowngrade'];
    $namaBarang = $_POST['namaBarang'];
    $grade = $_POST['grade'];
    $jenisBarang = $_POST['jenisBarang'];
    $netto = $_POST['netto'];
    $choosenGrade = $_POST['choosenGrade'];
    
    $checkBarang = mysqli_query($conn, "SELECT * FROM master_barang WHERE nama = '$namaBarang' AND grade = '$grade' AND jenis_barang ='$jenisBarang'");

    $checkBarangUpdate = mysqli_query($conn, "SELECT * FROM master_barang WHERE nama = '$namaBarang' AND grade = '$choosenGrade' AND jenis_barang ='$jenisBarang'");

    if (mysqli_num_rows($checkBarang) === 1) {
        $rowMaster = mysqli_fetch_assoc($checkBarang);
        $stok = intval($rowMaster['stok']);
        $downgrade_stok = $stok - $netto;
        var_dump($downgrade_stok);
        
        $updateBarangLama = "UPDATE master_barang SET stok = '$downgrade_stok' WHERE nama = '$namaBarang' AND grade = '$grade' AND jenis_barang ='$jenisBarang'";

        if (mysqli_query($conn, $updateBarangLama)) {
            if (mysqli_num_rows($checkBarangUpdate) === 1) {
                $rowChoosen = mysqli_fetch_assoc($checkBarangUpdate);
                $stokChoosen = intval($rowChoosen['stok']);
    
                $count = $stokChoosen + $netto;
                var_dump($count);
    
                $update = "UPDATE master_barang SET stok = '$count' WHERE nama = '$namaBarang' AND grade = '$choosenGrade' AND jenis_barang ='$jenisBarang'";
    
                $updateStatus = "UPDATE barang_masuk SET grade = '$choosenGrade' WHERE id_barang_masuk = '$idBarang'";

                if (mysqli_query($conn, $update)) {
                    if (mysqli_query($conn, $updateStatus)) { 
                        echo "
                        <div class='alert alert-success text-center' role='alert'>
                            Tambah Stok Berhasil
                        </div>
                            ";
                        header("Refresh:3");
                    } else {
                        echo "
                        <div class='alert alert-danger text-center' role='alert'>" .
                            $updateStatus . "<br>" . mysqli_error($conn)
                            . "</div>";
                    }
                } else {
                    echo "
                        <div class='alert alert-danger text-center' role='alert'>" .
                        $update . "<br>" . mysqli_error($conn)
                        . "</div>";
                }
            } else {
                $insertBarang = "INSERT INTO master_barang (nama,jenis_barang,grade)VALUES('$namaBarang', '$jenisBarang','$choosenGrade')";

                if (mysqli_query($conn, $insertBarang)) {
                    $checkBarangUpdate = mysqli_query($conn, "SELECT * FROM master_barang WHERE nama = '$namaBarang' AND grade = '$choosenGrade' AND jenis_barang ='$jenisBarang'");

                    if (mysqli_num_rows($checkBarangUpdate) === 1) {
                        $newRow= mysqli_fetch_assoc($checkBarangUpdate);
                        $stokChoosen = intval($newRow['stok']);

                        $result = $stokChoosen + $netto; 
                        var_dump($result);
                        $update = "UPDATE master_barang SET stok = '$result' WHERE nama = '$namaBarang' AND grade = '$choosenGrade' AND jenis_barang ='$jenisBarang'";
                        $updateStatus = "UPDATE barang_masuk SET grade = '$choosenGrade' WHERE id_barang_masuk = '$idBarang'";

                        if (mysqli_query($conn, $update)) {
                            if (mysqli_query($conn, $updateStatus)) { 
                                echo "
                                <div class='alert alert-success text-center' role='alert'>
                                    Tambah Stok Berhasil
                                </div>
                                    ";
                                header("Refresh:3");
                            } else {
                                echo "
                                <div class='alert alert-danger text-center' role='alert'>" .
                                    $updateStatus . "<br>" . mysqli_error($conn)
                                    . "</div>";
                            }
                        } else {
                            echo "
                            <div class='alert alert-success text-center' role='alert'>
                                Error
                            </div>
                                ";
                            header("Refresh:3");
                        }
                    } else {
                        echo "
                        <div class='alert alert-success text-center' role='alert'>
                            Error
                        </div>
                            ";
                        header("Refresh:3");
                    }
                } else {
                    echo "
                    <div class='alert alert-danger text-center' role='alert'>" .
                    $insertBarang . "<br>" . mysqli_error($conn)
                    . "</div>";
                }
            }
        } else {
            echo "
            <div class='alert alert-success text-center' role='alert'>
                ERROR
            </div>
                ";
        }
       
    } else {
        echo "
        <div class='alert alert-success text-center' role='alert'>
            ERROR
        </div>
            ";
    }
}

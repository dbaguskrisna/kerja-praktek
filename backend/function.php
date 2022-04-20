<?php
    $conn = mysqli_connect("localhost", "root", "", "coba");
    function query($query) {
        global $conn; //untuk mengambil variable mysqli diatas
        $result = mysqli_query($conn,$query); //untuk melakukan queery
        $rows = [];//tempat untuk menampung row
        
        if(empty($result))
        {
            return false;
        }
        else
        {
            while ($row = mysqli_fetch_assoc($result))
            {
                $rows[] = $row; //untuk menambahkan elemen baru ke tiap array kayak 1 1 masuknya
            }
            return $rows;
        }
    }

    function insertSupplier($ship){
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
            <div class='alert alert-danger text-center' role='alert'>".
                $sql . "<br>" . mysqli_error($conn)
            ."</div>";
            header("refresh: 3;");
        }
    }

    function updateSupplier($data){
        
        global $conn;//untuk connect ke database
        $id = $_POST['idSupplier'];
        $namaSupp = $_POST['namaSupplier'];
        $alamat =$_POST['alamat'];
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
            <div class='alert alert-danger text-center' role='alert'>".
                $sql . "<br>" . mysqli_error($conn)
            ."</div>";
            header("refresh: 3;");
        }
    }

    function deleteSupplier($data){
        global $conn;//untuk connect ke database
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
            <div class='alert alert-danger text-center' role='alert'>".
                $sql . "<br>" . mysqli_error($conn)
            ."</div>";
            header("refresh: 3;");
        }
    }

    function insertUser($user){
        global $conn; 
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $username = $_POST['username'];
        $password = md5(md5('alvian'.$_POST['password']));
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
            <div class='alert alert-danger text-center' role='alert'>".
                $sql . "<br>" . mysqli_error($conn)
            ."</div>";
            header("refresh: 3;");
        }
    }

    function updateUser($user){
        global $conn;//untuk connect ke database
        $id = $_POST['idUpdate'];
        $username = $_POST['usernameUpdate'];
        $password = md5(md5('alvian'.$_POST['passwordUpdate']));
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
            <div class='alert alert-danger text-center' role='alert'>".
                $sql . "<br>" . mysqli_error($conn)
            ."</div>";
            header("refresh: 3;");
        }
    }

    function deleteUser($data){
        global $conn;//untuk connect ke database
        $id = $_POST["idSupplier"];
        $sql = "DELETE FROM supplier WHERE id_user=$id";

        if (mysqli_query($conn, $sql)) {
            echo "
                <div class='alert alert-success text-center' role='alert'>
                    Delete data user sukses
                </div>
            ";
            header("refresh: 3;");
        } else {
            echo "
            <div class='alert alert-danger text-center' role='alert'>".
                $sql . "<br>" . mysqli_error($conn)
            ."</div>";
            header("refresh: 3;");
        }
    }

    function insertSupplierPayment($data){
        global $conn; 
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $tanggal = $_POST['tanggal'];
        $namaSupplier = $_POST['supplier'];
        $jumlahTransfer = $_POST['jumlahTransfer'];
        $bank =$_POST['bank'];
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

    function updateSupplierPayment($data){
        global $conn; 
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $tanggal = $_POST['tanggal'];
        $id = $_POST['id'];
        $jumlahTransfer = $_POST['jumlahTransfer'];
        $bank =$_POST['bank'];
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
            <div class='alert alert-danger text-center' role='alert'>".
                $sql . "<br>" . mysqli_error($conn)
            ."</div>";
        }
    }

    function deleteSupplierPayment($data){
        global $conn;//untuk connect ke database
        $id = $_POST["id"];
        $sql = "DELETE FROM pembayaran_supplier WHERE id=$id";

        if(mysqli_query($conn,$sql)){
            header("Refresh:2");
            echo "
            <div class='alert alert-success text-center' role='alert'>
                Delete data user sukses
            </div>
                ";
        }else {
            
            echo "
            <div class='alert alert-danger text-center' role='alert'>
                Delete data user gagal
            </div>
            ";    
        }
    }

    function insertKapal($data){
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
            <div class='alert alert-danger text-center' role='alert'>".
                $sql . "<br>" . mysqli_error($conn)
            ."</div>";
        }
    }

    function updateKapal($data){
        global $conn; 
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $id=$_POST['idUpdate'];
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
            <div class='alert alert-danger text-center' role='alert'>
                Update data kapal gagal
            </div>
            ";    
        }
       
    }

    function deleteKapal($data){
        global $conn;//untuk connect ke database
        $id = $_POST["idDelete"];
        $sql = "DELETE FROM kapal WHERE id_kapal=$id";

        if(mysqli_query($conn,$sql)){
            header("Refresh:3");
            echo "
            <div class='alert alert-success text-center' role='alert'>
                Menghapus data kapal sukses
            </div>
                ";
        }else {
            echo "
            <div class='alert alert-danger text-center' role='alert'>
                Menghapus data kapal gagal
            </div>
            ";    
        }
    }

    function insertStockin($data){
        
        global $conn; 
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $container = $_POST['container'];
        $tanggal = $_POST['tanggal'];
        $namaBarang = $_POST['nama_barang'];
        $jenisBarang = $_POST['jenis_barang'];
        $gradeBarang = $_POST['grade_barang'];
        $truck = $_POST['truck'];
        $nomorSeal = $_POST ['nomor_seal'];
        $asalBarang = $_POST['asal_barang'];
        $coly=$_POST['coly'];
        $gross=$_POST['gross'];
        $netto=$_POST['netto'];
        $supplier=$_POST['supplier'];
        

        $sql = "INSERT INTO barang_masuk (container,tanggal,nama_barang,jenis_barang,grade_barang,truck,nomor_seal,asal_barang,coly,gross,netto,supplier_id_supplier) VALUES ('$container', '$tanggal', '$namaBarang', '$jenisBarang', '$gradeBarang', '$truck', '$nomorSeal', '$asalBarang', '$coly', '$gross', '$netto','$supplier')";
        var_dump($sql);
        if (mysqli_query($conn, $sql)) {
            header("Refresh:3");
            echo "
            <div class='alert alert-success text-center' role='alert'>
                Tambah data Stock in sukses
            </div>
            ";
        } else {
            
            echo "
            <div class='alert alert-danger text-center' role='alert'>
                Tambah data Stock in gagal
            </div>
            ";    
        }
    }

    function updateStockin($data){
        global $conn; 
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $id=$_POST['id'];
        $supplier=$_POST['id_supplier'];
        $conatiner = $_POST['container'];
        $tanggal = $_POST['tanggal'];
        $namaBarang = $_POST['nama_barang'];
        $jenisBarang = $_POST['jenis_barang'];
        $gradeBarang = $_POST['grade_barang'];
        $truck = $_POST['truck'];
        $nomorSeal = $_POST ['nomor_seal'];
        $asalBarang = $_POST['asal_barang'];
        $coly=$_POST['coly'];
        $gross=$_POST['gross'];
        $netto=$_POST['netto'];

        $sql = "UPDATE barang_masuk SET supplier_id_supplier = '$supplier', container = '$conatiner', tanggal = '$tanggal',nama_barang = '$namaBarang', jenis_barang = '$jenisBarang',grade_barang = '$gradeBarang', truck = '$truck',nomor_seal = '$nomorSeal', asal_barang = '$asalBarang',coly = '$coly', gross = '$gross',netto = '$netto' WHERE id = '$id'";
        if (mysqli_query($conn, $sql)) {
            header("Refresh:3");
            echo "
            <div class='alert alert-success text-center' role='alert'>
                Update data stock in sukses
            </div>
                ";
        } else {
            echo "
            <div class='alert alert-danger text-center' role='alert'>
                Update data stock in gagal
            </div>
            ";    
        }
       
    }

    function deleteStockin($data){
        global $conn;//untuk connect ke database
        $id = $_POST["id"];
        $sql = "DELETE FROM barang_masuk WHERE id=$id";

        if(mysqli_query($conn,$sql)){
            header("Refresh:2");
            echo "
            <div class='alert alert-success text-center' role='alert'>
                Delete data Stock in sukses
            </div>
                ";
        }else {
            echo "
            <div class='alert alert-danger text-center' role='alert'>
                Delete data Stock in gagal
            </div>
            ";    
        }
    }

    function insertStockout($data){
        
        global $conn; 
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $id=$_POST['id'];
        $tanggal = $_POST['tanggal'];
        $contractno =$_POST['contract_no'];
        $consigne = $_POST['consigne'];
        $notifyParty=$_POST['notify_party'];
        $portofloading = $_POST['port_of_loading'];
        $countryoforigin = $_POST['country_of_origin'];
        $destination = $_POST['destination'];
        $description = $_POST['description'];
        $packing= $_POST['packing'];
        $namaBarang=$_POST['nama_barang'];
        $jenisBarang=$_POST['jenis_barang'];
        $gradeBarang = $_POST['grade_barang'];
        $freight = $_POST['freight'];
        $id_kapal= $_POST['kapal_id'];
        $pembayaranCustomer= $_POST['pembayaran_customer_id'];



        $sql = "INSERT INTO barang_keluar (tanggal,contract_no,consigne,notify_party,port_of_loading,country_of_origin,destination,description,packing,nama_barang,jenis_barang,jenis_barang,supplier_id_supplier,grade_barang,freight,kapal_id,pembayaran_customer_id) VALUES ('$tanggal', '$contractno', '$consigne', '$notifyParty', '$portofloading', '$countryoforigin', '$destination', '$description', '$packing', '$namaBarang', '$jenisBarang',$gradeBarang, '$freight', '$id_kapal', '$pembayaranCustomer')";
    
        if (mysqli_query($conn, $sql)) {
            header("Refresh:3");
            echo "
            <div class='alert alert-success text-center' role='alert'>
                Tambah data Stock in sukses
            </div>
            ";
        } else {
            echo "
            <div class='alert alert-danger text-center' role='alert'>
                Tambah data Stock in gagal
            </div>
            ";    
        }
    }

    function updateStockout($data){
        global $conn; 
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $tanggal = $_POST['tanggal'];
        $contractno =$_POST['contract_no'];
        $consigne = $_POST['consigne'];
        $notifyParty=$_POST['notify_party'];
        $portofloading = $_POST['port_of_loading'];
        $countryoforigin = $_POST['country_of_origin'];
        $destination = $_POST['destination'];
        $description = $_POST['description'];
        $packing= $_POST['packing'];
        $namaBarang=$_POST['nama_barang'];
        $jenisBarang=$_POST['jenis_barang'];
        $alamatTujuan = $_POST['alamat_tujuan'];
        $freight = $_POST['freight'];
        $id_kapal= $_POST['kapal_id'];
        $pembayaranCustomer= $_POST['pembayaran_customer_id'];

        $sql = "UPDATE barang_keluar SET tanggal = '$tanggal', contract_no = '$consigne',consigne = '$notifyParty', jenis_barang = '$portofloading',grade_barang = '$countryoforigin', truck = '$destination',nomorSeal = '$description', asal_barang = '$packing',coly = '$namaBarang', gross = '$jenisBarang',netto = '$alamatTujuan',coly = '$freight', gross = '$id_kapal',netto = '$pembayaranCustomer', WHERE id = '$id'";
        
        if (mysqli_query($conn, $sql)) {
            header("Refresh:3");
            echo "
            <div class='alert alert-success text-center' role='alert'>
                Update data stock in sukses
            </div>
                ";
        } else {
            echo "
            <div class='alert alert-danger text-center' role='alert'>
                Update data stock in gagal
            </div>
            ";    
        }
       
    }

    function deleteStockout($data){
        global $conn;//untuk connect ke database
        $id = $_POST["id"];
        $sql = "DELETE FROM barang_masuk WHERE id=$id";

        if(mysqli_query($conn,$sql)){
            header("Refresh:3");
            echo "
            <div class='alert alert-success text-center' role='alert'>
                Delete data Stock in sukses
            </div>
                ";
        }else {
            echo "
            <div class='alert alert-danger text-center' role='alert'>
                Delete data Stock in gagal
            </div>
            ";    
        }
    }

    function insertKontainer($data){
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
            <div class='alert alert-danger text-center' role='alert'>".
                $sql . "<br>" . mysqli_error($conn)
            ."</div>";
        }
    }

    function updateKontainer($data){
        global $conn; 
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $id=$_POST['idUpdate'];
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
            <div class='alert alert-danger text-center' role='alert'>".
                $sql . "<br>" . mysqli_error($conn)
            ."</div>";
        }
       
    }

    function deleteKontainer($data){
        global $conn;//untuk connect ke database
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
            <div class='alert alert-danger text-center' role='alert'>".
                $sql . "<br>" . mysqli_error($conn)
            ."</div>";
        }
    }

    function insertCustomerData($data){
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
            <div class='alert alert-danger text-center' role='alert'>".
                $sql . "<br>" . mysqli_error($conn)
            ."</div>";
        }
    }

    function updateCustomerData($data){
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
            <div class='alert alert-danger text-center' role='alert'>".
                $sql . "<br>" . mysqli_error($conn)
            ."</div>";
        }
    }

    function deleteCustomerData($data){
        global $conn;//untuk connect ke database
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
            <div class='alert alert-danger text-center' role='alert'>".
                $sql . "<br>" . mysqli_error($conn)
            ."</div>";
        }
    }

    function insertPembayaranSupplier($user){

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

        $sql = "INSERT INTO pembayaran_supplier (nomor_nota, tanggal, jumlah_pembayaran, total_barang,status_pembayaran,bank,supplier_id_supplier,nama,jenis_barang,grade,asal)VALUES('$nomor_nota', '$tanggal', '$jumlah_pembayaran', '$total_barang','$status_pembayaran','$bank','$supplier', '$nama_barang','$jenis_barang','$grade_barang','$asal')";
        
        if (mysqli_query($conn, $sql)) {
            echo "
                <div class='alert alert-success text-center' role='alert'>
                    Menambahkan data pembayaran supplier sukses
                </div>
            ";
            header("refresh: 3;");
        } else {
            echo "
            <div class='alert alert-danger text-center' role='alert'>".
                $sql . "<br>" . mysqli_error($conn)
            ."</div>";
            
        }
    }

    function updatePembayaranSupplier($user){

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
            <div class='alert alert-danger text-center' role='alert'>".
                $sql . "<br>" . mysqli_error($conn)
            ."</div>";
        }
    }

    function deletePembayaranSupplier($data){
        global $conn;//untuk connect ke database
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
            <div class='alert alert-danger text-center' role='alert'>".
                $sql . "<br>" . mysqli_error($conn)
            ."</div>";
        }
    }

?>

<div class="card-group-title">
    <div class="title-left">
        <img src="../../../data/tmp/membercard/files/icon/database.png" width="40" height="40" alt="Grafik">
        <p>Backup & Restore</p>
    </div>

</div>
<style>
    .backup-restore-card {
        background: #ffffff;
        padding: 25px;
        border-radius: 12px;
        margin-top: 15px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .big-btn {
        display: block;
        width: 260px;
        padding: 18px 0;
        text-align: center;
        background: #f5f6fa;
        border-radius: 10px;
        font-size: 18px;
        font-weight: 600;
        color: #333;
        text-decoration: none;
        transition: 0.25s ease;
        border: 1px solid #e1e1e1;
    }

    .big-btn:hover {
        background: #e9ecf3;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .backup-btn {
        color: #1d7dfc;
        border-color: #1d7dfc33;
    }

    .restore-btn {
        color: #e03131;
        border-color: #e0313133;
    }
</style>


<div class="backup-restore-card">
    <a href="index.php?input=backup" class="big-btn backup-btn">

        <center><img src="../../../data/tmp/membercard/files/icon/restore.png" width="80" height="80" alt="Grafik">
        </center>
        <br>
        Backup Database
    </a>
    <a href="index.php?input=restore" class="big-btn restore-btn">
        <center><img src="../../../data/tmp/membercard/files/icon/backup.png" width="80" height="80" alt="Grafik">
        </center>
        <br>
        Restore Database
    </a>
</div>
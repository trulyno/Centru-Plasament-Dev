<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_username'])) {
    header('Location: login.php');
    exit;
}

// Include required files
require_once __DIR__ . '/../includes/lang.php';
require_once __DIR__ . '/../includes/gdpr.php';
require_once __DIR__ . '/../includes/analytics.php';

// Get analytics data
$analytics = AnalyticsManager::getAnalyticsSummary(30);
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo t('analytics_title'); ?> - Admin Dashboard</title>
    <link rel="icon" href="../images/logo.ico" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../gdpr-styles.css" rel="stylesheet">
    <link href="admin-style.css" rel="stylesheet">
</head>
<body class="admin-body">
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="admin-logo">
                <h2>Admin Panel</h2>
            </div>
            <nav class="admin-nav">
                <ul>
                    <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="analytics.php" class="active"><i class="fas fa-chart-bar"></i> <?php echo t('analytics_title'); ?></a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-header">
                <h1><?php echo t('analytics_title'); ?></h1>
                <p><?php echo t('analytics_last_30_days'); ?></p>
            </div>

            <?php if ($analytics['total_page_views'] === 0): ?>
                <div class="analytics-no-data">
                    <i class="fas fa-chart-line"></i>
                    <h3><?php echo t('analytics_no_data'); ?></h3>
                    <p>Datele de analiză vor apărea aici după ce vizitatorii vor interacționa cu site-ul.</p>
                </div>
            <?php else: ?>
                <!-- Statistics Cards -->
                <div class="analytics-stats-grid">
                    <div class="analytics-stat-card">
                        <h3><?php echo number_format($analytics['total_page_views']); ?></h3>
                        <p><?php echo t('analytics_page_views'); ?></p>
                    </div>
                    <div class="analytics-stat-card">
                        <h3><?php echo number_format($analytics['unique_visitors']); ?></h3>
                        <p><?php echo t('analytics_unique_visitors'); ?></p>
                    </div>
                    <div class="analytics-stat-card">
                        <h3><?php echo count($analytics['top_pages']); ?></h3>
                        <p>Pagini vizitate</p>
                    </div>
                    <div class="analytics-stat-card">
                        <h3><?php echo count($analytics['browsers']); ?></h3>
                        <p>Tipuri de browsere</p>
                    </div>
                </div>

                <!-- Charts -->
                <div class="analytics-charts-grid">
                    <!-- Top Pages -->
                    <div class="analytics-chart-card">
                        <h3><?php echo t('analytics_top_pages'); ?></h3>
                        <ul class="analytics-list">
                            <?php foreach (array_slice($analytics['top_pages'], 0, 10) as $page => $views): ?>
                                <li>
                                    <span><?php echo htmlspecialchars($page); ?></span>
                                    <span><?php echo number_format($views); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Traffic Sources -->
                    <div class="analytics-chart-card">
                        <h3><?php echo t('analytics_referrers'); ?></h3>
                        <ul class="analytics-list">
                            <?php if (empty($analytics['top_referrers'])): ?>
                                <li><span>Trafic direct</span><span><?php echo number_format($analytics['total_page_views']); ?></span></li>
                            <?php else: ?>
                                <?php foreach (array_slice($analytics['top_referrers'], 0, 10) as $referrer => $count): ?>
                                    <li>
                                        <span><?php echo htmlspecialchars($referrer); ?></span>
                                        <span><?php echo number_format($count); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- Browsers -->
                    <div class="analytics-chart-card">
                        <h3><?php echo t('analytics_browsers'); ?></h3>
                        <ul class="analytics-list">
                            <?php foreach ($analytics['browsers'] as $browser => $count): ?>
                                <li>
                                    <span><?php echo htmlspecialchars($browser); ?></span>
                                    <span><?php echo number_format($count); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Hourly Distribution -->
                    <div class="analytics-chart-card">
                        <h3><?php echo t('analytics_hourly'); ?></h3>
                        <div class="hourly-chart">
                            <?php 
                            $maxHourly = max($analytics['hourly_distribution']);
                            for ($i = 0; $i < 24; $i++): 
                                $height = $maxHourly > 0 ? ($analytics['hourly_distribution'][$i] / $maxHourly) * 100 : 0;
                            ?>
                                <div class="hourly-bar" style="height: <?php echo $height; ?>%" title="<?php echo $i; ?>:00 - <?php echo $analytics['hourly_distribution'][$i]; ?> vizualizări">
                                    <span class="hourly-value"><?php echo $analytics['hourly_distribution'][$i]; ?></span>
                                    <span class="hourly-label"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></span>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>

                <!-- Daily Traffic -->
                <div class="analytics-chart-card" style="grid-column: 1 / -1;">
                    <h3><?php echo t('analytics_daily'); ?></h3>
                    <div class="daily-chart">
                        <?php 
                        $maxDaily = max(array_merge($analytics['daily_views'], [1]));
                        $days = array_slice($analytics['daily_views'], -14, 14, true); // Last 14 days
                        foreach ($days as $date => $views): 
                            $height = $maxDaily > 0 ? ($views / $maxDaily) * 100 : 0;
                            $dateFormatted = date('M d', strtotime($date));
                        ?>
                            <div class="daily-bar" style="height: <?php echo $height; ?>%" title="<?php echo $dateFormatted; ?> - <?php echo $views; ?> vizualizări">
                                <span class="daily-value"><?php echo $views; ?></span>
                                <span class="daily-label"><?php echo $dateFormatted; ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <style>
        .analytics-no-data {
            text-align: center;
            padding: 4rem 2rem;
            color: #6c757d;
        }

        .analytics-no-data i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .hourly-chart, .daily-chart {
            display: flex;
            align-items: end;
            gap: 4px;
            height: 200px;
            padding: 1rem 0;
        }

        .hourly-bar, .daily-bar {
            flex: 1;
            background: #3498db;
            border-radius: 2px 2px 0 0;
            position: relative;
            min-height: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        .hourly-value, .daily-value {
            position: absolute;
            top: -25px;
            font-size: 0.7rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .hourly-label, .daily-label {
            position: absolute;
            bottom: -20px;
            font-size: 0.7rem;
            color: #6c757d;
            transform: rotate(-45deg);
            transform-origin: center;
        }

        .daily-chart .daily-bar {
            background: #27ae60;
        }
    </style>
</body>
</html>

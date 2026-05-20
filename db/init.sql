CREATE TABLE IF NOT EXISTS utm_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    source VARCHAR(255) NOT NULL,
    medium VARCHAR(255) NOT NULL,
    campaign VARCHAR(255) NOT NULL,
    content VARCHAR(255) NULL,
    term VARCHAR(255) NULL,
    created DATETIME NULL,
    modified DATETIME NULL,

    INDEX idx_source (source),
    INDEX idx_source_medium_campaign (source, medium, campaign)
);
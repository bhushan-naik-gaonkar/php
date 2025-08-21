CREATE TABLE IF NOT EXISTS departments (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(190) NOT NULL UNIQUE,
	description TEXT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS teams (
	id INT AUTO_INCREMENT PRIMARY KEY,
	department_id INT NULL,
	name VARCHAR(190) NOT NULL,
	description TEXT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT fk_team_department FOREIGN KEY (department_id)
		REFERENCES departments (id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS resources (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(190) NOT NULL,
	type VARCHAR(100) NOT NULL,
	owner VARCHAR(190) NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS resource_links (
	id INT AUTO_INCREMENT PRIMARY KEY,
	resource_id INT NOT NULL,
	department_id INT NULL,
	team_id INT NULL,
	link_type ENUM('ownership','uses','supports','related') NOT NULL DEFAULT 'related',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT fk_rl_resource FOREIGN KEY (resource_id) REFERENCES resources(id) ON DELETE CASCADE,
	CONSTRAINT fk_rl_department FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE SET NULL,
	CONSTRAINT fk_rl_team FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE SET NULL,
	CONSTRAINT chk_rl_target CHECK ((department_id IS NOT NULL) XOR (team_id IS NOT NULL))
);

CREATE INDEX idx_teams_department ON teams(department_id);
CREATE INDEX idx_rl_resource ON resource_links(resource_id);
CREATE INDEX idx_rl_department ON resource_links(department_id);
CREATE INDEX idx_rl_team ON resource_links(team_id);



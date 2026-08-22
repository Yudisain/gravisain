export const Grid = ({ children, className = '', columns = 1, gap = 4, align = 'stretch', ...props }) => {
	const classes = [
		'gravisain-grid',
		className,
	].filter(Boolean).join(' ');

	const styles = {
		display: 'grid',
		gridTemplateColumns: `repeat(${columns}, minmax(0, 1fr))`,
		gap: `var(--gravisain-spacing-${gap}, ${gap * 0.25}rem)`,
		alignItems: align,
	};

	return (
		<div className={classes} style={styles} {...props}>
			{children}
		</div>
	);
};

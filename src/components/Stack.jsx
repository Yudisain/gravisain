export const Stack = ({ children, className = '', spacing = 4, direction = 'column', align = 'flex-start', justify = 'flex-start', ...props }) => {
	const classes = [
		'gravisain-stack',
		className,
	].filter(Boolean).join(' ');

	const styles = {
		display: 'flex',
		flexDirection: direction,
		alignItems: align,
		justifyContent: justify,
		gap: `var(--gravisain-spacing-${spacing}, ${spacing * 0.25}rem)`,
	};

	return (
		<div className={classes} style={styles} {...props}>
			{children}
		</div>
	);
};

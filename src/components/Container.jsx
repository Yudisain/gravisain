export const Container = ({ children, className = '', maxWidth, padding, alignment, ...props }) => {
	const classes = [
		'gravisain-container',
		maxWidth ? `max-w-${maxWidth}` : '',
		padding ? `p-${padding}` : '',
		alignment ? `align-${alignment}` : '',
		className,
	].filter(Boolean).join(' ');

	return (
		<div className={classes} {...props}>
			{children}
		</div>
	);
};

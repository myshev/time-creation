<?php


class sfValidatorFileThumb extends sfValidatorFile {
	/**
	 * Configures the current validator.
	 *
	 * @access protected
	 *
	 * @param array $options   An array of options
	 * @param array $messages  An array of error messages
	 */
protected function configure($options = array(), $messages = array())
{
// First configure the parent object
	parent::configure($options, $messages);

// Add options
	$this->addOption('with_thumb', isset($options['with_thumb']) ? $options['with_thumb'] : false);
	$this->addOption('thumb_path', isset($options['thumb_path']) ? $options['thumb_path'] : sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'assets');
	$this->addOption('thumb_dimensions', isset($options['thumb_dimensions']) ? $options['thumb_dimensions'] : null);
	$this->addOption('thumb_scale', isset($options['thumb_scale']) ? $options['thumb_scale'] : false);
	$this->addOption('thumb_inflate', isset($options['thumb_inflate']) ? $options['thumb_inflate'] : false);
	$this->addOption('thumb_quality', isset($options['thumb_quality']) ? $options['thumb_quality'] : false);

	$this->addOption('with_resize_full', isset($options['with_resize_full']) ? $options['with_resize_full'] : false);
	$this->addOption('full_dimensions', isset($options['full_dimensions']) ? $options['full_dimensions'] : null);
// Add messages:
//    $this->addMessage('thumb_path', 'Path does not exists or directory is not writeble!');

// Add our custom class that will handle uploaded file
	$this->addOption('validated_file_class', 'withThumbnailValidatedFile');
}

/**
 * Make validation for a file
 *
 * @access protected
 * @author Roman Dushko
 *
 * @see sfValidatorFile
 */
protected function doClean($value)
{
// Validated file object
	$validatedFileObj = parent::doClean($value);

	if ($this->getOption('with_thumb') || $this->getOption('with_resize_full')) {
// Check if plugin sfThumpnailPlugin exists
		if (!class_exists('sfThumbnail')) // @todo: Could we not to check if plugin is enabled? Or should we check?
		{
			throw new Exception(sprintf('A class for making the thumbnails "%s" is not found', 'sfThumbnail'));
		}

// Check if a path where thumbnail will be stored is provided
		if (null === $this->getOption('thumb_path')) {
			throw new Exception('Path to thumbnails is not provided!');
		}

		if (null === $this->getOption('path')) {
			throw new Exception('Path to image is not provided!');
		}

// Set needed validated file properties
		$validatedFileObj->setWithThumbnail(true);
		$validatedFileObj->setWithResizeImage(true);

		$validatedFileObj->setThumbProperties(
						array(
				'thumb_path' => $this->getOption('thumb_path'),
				'thumb_dimensions' => $this->getOption('thumb_dimensions'),
				'thumb_scale' => $this->getOption('thumb_scale'),
				'thumb_inflate' => $this->getOption('thumb_inflate'),
				'thumb_quality' => $this->getOption('thumb_quality'),

				'full_dimensions' => $this->getOption('full_dimensions'),
				'path'			=> $this->getOption('path')
			)
		);
	}

	return $validatedFileObj;
}

}

class withThumbnailValidatedFile extends sfValidatedFile
{
	protected $withTumbnail = false;
	protected $withResizeImage = false;

	protected $thumbProperties = array(
		'thumb_path' => null,
		'thumb_dimensions' => null,
		'thumb_scale' => false,
		'thumb_inflate' => false,
		'thumb_quality' => null,

		'full_dimensions'	=> null
	);

	public function save($file = null, $fileMode = 0666, $create = true, $dirMode = 0777)
	{
// Save original image
		$savedFile = parent::save($file, $fileMode, $create, $dirMode);

// Check if we need to upload a thumbnail
		if ($this->withTumbnail) {
// Get dimension for thumbnail
			$thumbDimensions = $this->getThumbProperty('thumb_dimensions');
			if ($thumbDimensions) {
				$thumbWidth = isset($thumbDimensions['width']) ? $thumbDimensions['width'] : null;
				$thumbHeight = isset($thumbDimensions['height']) ? $thumbDimensions['height'] : null;
			}

// Create instance of thumbnailer
			/**
			 * @todo: make it possible to define 'adapterClass' for sfThumbnail (and it's options) in factories.yml
			 */
			$thumnailer = new sfThumbnail(
				$thumbWidth,
				$thumbHeight,
				$this->getThumbProperty('thumb_scale'),
				$this->getThumbProperty('thumb_inflate'),
				$this->getThumbProperty('thumb_quality')
			);
// Load saved file
			$thumnailer->loadFile($this->getSavedName());
// Save a thumbnail
			$thumnailer->save($this->getThumbProperty('thumb_path') . DIRECTORY_SEPARATOR . basename($this->getSavedName()));
		}

		/*ресайзим основную картинку*/
		if ($this->withResizeImage) {
			$fullDimensions = $this->getThumbProperty('full_dimensions');
			if ($fullDimensions) {
				$fullWidth = isset($fullDimensions['width']) ? $fullDimensions['width'] : null;
				$fullHeight = isset($fullDimensions['height']) ? $fullDimensions['height'] : null;
			}

			$image = new sfThumbnail(
				$fullWidth,
				$fullHeight
			);

			$sFile = $this->getThumbProperty('path') . DIRECTORY_SEPARATOR . basename($this->getSavedName());

			$sfImage = new sfImage($sFile, $this->getType());

			if($fullWidth < $sfImage->getWidth()) {
				$image->loadFile($this->getSavedName());
				$image->save($sFile);
			}
		}

		return $savedFile;
	}

	public function setWithThumbnail($with_thumb = false)
	{
		$this->withTumbnail = $with_thumb;
	}

	public function setWithResizeImage($with_resize_full = false)
	{
		$this->withResizeImage = $with_resize_full;
	}

	public function getWithThumbnail()
	{
		return $this->withTumbnail;
	}

	public function setThumbProperties($properties)
	{
		$this->thumbProperties = $properties;
	}

	public function getThumbProperties()
	{
		return $this->thumbProperties;
	}

	public function getThumbProperty($propName)
	{
		return $this->thumbProperties[$propName];
	}

}

?>